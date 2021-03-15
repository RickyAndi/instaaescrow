<?php

namespace App\UseCases\Marketplace\GetOrderBook;

use Illuminate\Support\Collection;

class Response
{
    /**
     * @var Collection
     */
    private $buyOrders;

    /**
     * @var Collection
     */
    private $sellOrders;

    /**
     * @var Collection
     */
    private $userOrders;

    /**
     * @var Collection
     */
    private $userRequests;

    /**
     * Get the value of buyOrders
     */ 
    public function getBuyOrders(): Collection
    {
        return $this->buyOrders;
    }

    /**
     * Set the value of buyOrders
     *
     * @return  self
     */ 
    public function setBuyOrders(Collection $buyOrders): void
    {
        $this->buyOrders = $buyOrders;
    }

    /**
     * Get the value of sellOrders
     */ 
    public function getSellOrders(): Collection
    {
        return $this->sellOrders;
    }

    /**
     * Set the value of sellOrders
     *
     * @return  self
     */ 
    public function setSellOrders(Collection $sellOrders): void
    {
        $this->sellOrders = $sellOrders;
    }

    public function getUserOrders(): Collection
    {
        return $this->userOrders;
    }

    public function setUserOrders(Collection $userOrders)
    {
        $this->userOrders = $userOrders;
    }

    /**
     * Get the value of userRequests
     *
     * @return  Collection
     */ 
    public function getUserRequests(): Collection
    {
        return $this->userRequests;
    }

    /**
     * Set the value of userRequests
     *
     * @param  Collection  $userRequests
     */ 
    public function setUserRequests(Collection $userRequests): void
    {
        $this->userRequests = $userRequests;
    }
}
