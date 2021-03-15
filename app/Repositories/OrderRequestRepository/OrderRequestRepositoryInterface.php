<?php

namespace App\Repositories\OrderRequestRepository;

use Illuminate\Support\Collection;

interface OrderRequestRepositoryInterface
{
    public function getOpenOrderRequestByUserId(int $userId, $options = []): Collection;
}
