<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Acquisition\DiscoverHotelsRequest;
use App\Http\Requests\Acquisition\ImportLeadsRequest;
use App\Http\Requests\Acquisition\InviteLeadRequest;
use App\Models\AcquisitionLead;
use App\Services\Acquisition\HotelDiscoveryService;
use App\Services\Acquisition\LeadInvitationService;
use App\Services\Acquisition\LeadScoringService;
use App\Support\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AcquisitionController extends Controller
{
    public function __construct(
        private readonly HotelDiscoveryService $discoveryService,
        private readonly LeadScoringService $scoringService,
        private readonly LeadInvitationService $invitationService,
    ) {
    }

    public function discover(DiscoverHotelsRequest $request)
    {
        $result = $this->discoveryService->discover($request->validated());

        return ApiResponse::success($result, 'Hotel discovery completed', status: 202);
    }

    public function import(ImportLeadsRequest $request)
    {
        $file = $request->file('file');

        return ApiResponse::success([
            'job_id' => (string) Str::uuid(),
            'file_name' => $file?->getClientOriginalName(),
            'total_rows' => 0,
            'errors' => [],
        ], 'Lead import queued', status: 202);
    }

    public function leads(Request $request)
    {
        $leads = AcquisitionLead::query()
            ->with('scoreRecord')
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->when($request->filled('score_min'), fn ($query) => $query->where('score', '>=', (int) $request->input('score_min')))
            ->when($request->filled('score_max'), fn ($query) => $query->where('score', '<=', (int) $request->input('score_max')))
            ->latest()
            ->paginate((int) $request->input('per_page', 15));

        return ApiResponse::success(
            $leads->items(),
            'Acquisition leads retrieved',
            [
                'current_page' => $leads->currentPage(),
                'last_page' => $leads->lastPage(),
                'per_page' => $leads->perPage(),
                'total' => $leads->total(),
            ],
        );
    }

    public function show(AcquisitionLead $lead)
    {
        return ApiResponse::success(
            $lead->load(['scoreRecord', 'activities']),
            'Acquisition lead retrieved',
        );
    }

    public function score(AcquisitionLead $lead)
    {
        $score = $this->scoringService->score($lead);

        return ApiResponse::success($score, 'Lead score refreshed');
    }

    public function invite(InviteLeadRequest $request, AcquisitionLead $lead)
    {
        $result = $this->invitationService->invite($lead, $request->validated('channels'));

        return ApiResponse::success($result, 'Lead invitation sent');
    }
}
