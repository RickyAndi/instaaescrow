<?php

namespace App\UseCases\Marketplace\GetOrderBook;

use App\Repositories\OrderRepository\OrderRepositoryInterface;
use App\Repositories\OrderRequestRepository\OrderRequestRepositoryInterface;
use App\Services\AuthService\AuthServiceInterface;
use App\UseCases\Marketplace\GetOrderBook\Request;
use Illuminate\Support\Collection;

class UseCase
{
    private $orderRequestRepository;
    private $orderRepository;
    private $authService;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        AuthServiceInterface $authService,
        OrderRequestRepositoryInterface $orderRequestRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->authService = $authService;
        $this->orderRequestRepository = $orderRequestRepository;
    }

    public function handle(Request $request): Response
    {
        $user = $this->authService->getCurrentUser();

        $options = [
            'select' => [
                'id',
                'price',
                'price_per_unit',
                'cryptocurrency_amount'
            ]
        ];

        if (!is_null($user)) {
            $options['except_user_id'] = [
                $user->id
            ];
        }

        $buyOrders = $this->orderRepository
            ->getOrderedBuyOrder(30, $options);
        $sellOrders = $this->orderRepository
            ->getOrderedSellOrder(30, $options);
        
        $userOrders = new Collection([]);
        $userRequests = new Collection([]);
        
        if (!is_null($user)) {
            
            $userOrders = $this->orderRepository
                ->getOrdersByUserId($user->id, [
                    'select' => [
                        'id',
                        'price',
                        'price_per_unit',
                        'cryptocurrency_amount',
                        'type'
                    ]
                ]);

            $userRequests = $this->orderRequestRepository->getOpenOrderRequestByUserId(
                $user->id,
                [
                    'with' => 'order:id,price,price_per_unit,cryptocurrency_amount'
                ]
            );
        }

        $response = new Response();
        $response->setBuyOrders($buyOrders);
        $response->setSellOrders($sellOrders);
        $response->setUserOrders($userOrders);
        $response->setUserRequests($userRequests);

        return $response;
    }
}
