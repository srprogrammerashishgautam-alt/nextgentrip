<?php

namespace App\Services\Acquisition;

use App\Contracts\Acquisition\HotelDataProviderInterface;
use Illuminate\Support\Str;

class HotelDiscoveryService
{
    public function __construct(
        private readonly HotelDataProviderInterface $provider,
        private readonly LeadDeduplicationService $deduplication,
        private readonly LeadScoringService $scoring,
    ) {
    }

    public function discover(array $criteria): array
    {
        $jobId = (string) Str::uuid();
        $leads = [];

        foreach ($this->provider->discover($criteria) as $payload) {
            $payload['slug'] = Str::slug(($payload['hotel_name'] ?? '').' '.($payload['city'] ?? ''));
            $payload['status'] = 'new';

            $lead = $this->deduplication->findDuplicate($payload);

            if ($lead) {
                $lead->fill(array_filter($payload, fn ($value) => $value !== null))->save();
            } else {
                $lead = \App\Models\AcquisitionLead::create($payload);
            }

            $this->scoring->score($lead);
            $lead->activities()->create([
                'type' => 'discovered',
                'channel' => $payload['source'] ?? 'mock',
                'status' => 'completed',
                'notes' => 'Lead discovered from mocked acquisition provider.',
                'completed_at' => now(),
                'payload' => ['job_id' => $jobId, 'criteria' => $criteria],
            ]);

            $leads[] = $lead->fresh(['scoreRecord', 'activities']);
        }

        return [
            'job_id' => $jobId,
            'total_rows' => count($leads),
            'leads' => $leads,
        ];
    }
}
