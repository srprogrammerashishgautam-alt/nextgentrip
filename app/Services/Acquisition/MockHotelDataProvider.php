<?php

namespace App\Services\Acquisition;

use App\Contracts\Acquisition\HotelDataProviderInterface;
use Illuminate\Support\Str;

class MockHotelDataProvider implements HotelDataProviderInterface
{
    public function discover(array $criteria): array
    {
        $location = (string) ($criteria['location'] ?? 'Jaipur');
        $city = Str::of($location)->before(',')->title()->toString();

        return [
            [
                'hotel_name' => "{$city} Grand Residency",
                'source' => 'mock-google-maps',
                'website' => 'https://example.com/grand-residency',
                'email' => 'sales@grand-residency.example',
                'phone' => '+919999000001',
                'address' => "Airport Road, {$city}",
                'city' => $city,
                'state' => 'Rajasthan',
                'country' => 'India',
                'latitude' => 26.9124,
                'longitude' => 75.7873,
                'star_rating' => 4,
                'review_rating' => 4.4,
                'review_count' => 420,
                'estimated_room_count' => 86,
                'estimated_average_rate' => 5200,
                'ota_presence' => ['booking.com', 'expedia', 'makemytrip'],
                'nearby_points_of_interest' => ['airport', 'business district', 'hospital'],
                'raw_payload' => ['provider' => 'mock', 'criteria' => $criteria],
            ],
            [
                'hotel_name' => "{$city} Heritage Palace",
                'source' => 'mock-ota-scraper',
                'website' => 'https://example.com/heritage-palace',
                'email' => 'reservations@heritage-palace.example',
                'phone' => '+919999000002',
                'address' => "Old City, {$city}",
                'city' => $city,
                'state' => 'Rajasthan',
                'country' => 'India',
                'latitude' => 26.9239,
                'longitude' => 75.8267,
                'star_rating' => 5,
                'review_rating' => 4.7,
                'review_count' => 980,
                'estimated_room_count' => 140,
                'estimated_average_rate' => 9200,
                'ota_presence' => ['booking.com', 'expedia', 'agoda', 'makemytrip'],
                'nearby_points_of_interest' => ['tourist attraction', 'wedding venue'],
                'raw_payload' => ['provider' => 'mock', 'criteria' => $criteria],
            ],
        ];
    }
}
