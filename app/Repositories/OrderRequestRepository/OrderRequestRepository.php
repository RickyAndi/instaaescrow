<?php

namespace App\Repositories\OrderRequestRepository;

use App\Models\OrderRequest;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class OrderRequestRepository extends BaseRepository implements OrderRequestRepositoryInterface
{
    public function getOpenOrderRequestByUserId(int $userId, $options = []): Collection
    {
        $query = $this->model;

        if (isset($options['select'])) {
            $query = $query
                ->select($options['select']);
        }

        if (isset($options['with'])) {
            $query = $query
                ->with($options['with']);
        }

        return $query
            ->where('user_id', $userId)
            ->whereIn('status', [
                OrderRequest::STATUS_CREATED,
                OrderRequest::STATUS_ACCEPTED
            ])
            ->get();
    }
}
