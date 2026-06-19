<?php

namespace App\Contracts\Acquisition;

interface HotelDataProviderInterface
{
    public function discover(array $criteria): array;
}
