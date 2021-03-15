<?php

namespace App\Http\Controllers\Marketplace;

use Illuminate\Http\Request;
use App\Models\Cryptocurrency;
use App\Http\Controllers\Controller;
use App\UseCases\Marketplace\GetOrderBook\UseCase;
use App\UseCases\Marketplace\GetOrderBook\Request as UseCaseRequest;

class ShowOrderBookAction extends Controller
{
    private $useCase;

    public function __construct(
        UseCase $useCase
    )
    {
        $this->useCase = $useCase;
    }
    
    public function __invoke(Request $request)
    {
        try {
            $useCaseRequest = new UseCaseRequest();
            $useCaseRequest->setCryptoName(Cryptocurrency::BTC);

            $response = $this->useCase->handle($useCaseRequest);

            return view('marketplace.market', [
                'buyOrders' => $response->getBuyOrders(),
                'sellOrders' => $response->getSellOrders(),
                'userOrders' => $response->getUserOrders(),
                'userRequests' => $response->getUserRequests()
            ]);
            
        } catch (\Exception $e) {

            throw $e;
            
            return view('marketplace.market', [
                'buyOrders' => collect([]),
                'sellOrders' => collect([]),
                'userOrders' => collect([]),
                'userRequests' => collect([])
            ]);
        }
    }
}
