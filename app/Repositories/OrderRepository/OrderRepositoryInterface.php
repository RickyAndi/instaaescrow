<?php

namespace App\Repositories\OrderRepository;

use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function getOrderedBuyOrder(int $limit, $options = []): Collection;

    public function getOrderedSellOrder(int $limit, $options = []): Collection;

    public function getHistoryOrders(int $limit, $options = []): Collection;

    public function getOrdersByUserId(int $userId, $options = []): Collection;
}
