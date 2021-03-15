<?php

namespace App\Repositories\OrderRepository;

use App\Models\Order;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function getOrderedBuyOrder(int $limit, $options = []): Collection
    {
        $query = $this->model;

        if (isset($options['select'])) {
            $query = $query->select($options['select']);
        }

        if (isset($options['except_user_id'])) {
            $query = $query
                ->whereNotIn('initiator_id', $options['except_user_id']);
        }

        $query = $query
            ->where('type', Order::TYPE_BUY)
            ->orderBy('price', 'DESC')
            ->limit($limit);
        
        return $query->get();
    }

    public function getOrderedSellOrder(int $limit, $options = []): Collection
    {
        $query = $this->model;

        if (isset($options['select'])) {
            $query = $query->select($options['select']);
        }

        if (isset($options['except_user_id'])) {
            $query = $query
                ->whereNotIn('initiator_id', $options['except_user_id']);
        }

        return $query
            ->where('type', Order::TYPE_SELL)
            ->orderBy('price', 'ASC')
            ->limit($limit)
            ->get();
    }

    public function getHistoryOrders(int $limit, $options = []): Collection
    {
        $query = $this->model;

        if (isset($options['select'])) {
            $query = $query->select($options['select']);
        }

        return $query
            ->where('status', Order::STATUS_FINISHED)
            ->limit($limit)
            ->get();
    }

    public function getOrdersByUserId(int $userId, $options = []): Collection
    {
        $query = $this->model;

        if (isset($options['select'])) {
            $query = $query->select($options['select']);
        }

        if (isset($options['limit'])) {
            $query = $query->limit($options['limit']);
        }

        return $query
            ->where('initiator_id', $userId)
            ->get();
    }
}
