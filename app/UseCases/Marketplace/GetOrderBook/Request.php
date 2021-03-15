<?php

namespace App\UseCases\Marketplace\GetOrderBook;

class Request
{
    /**
     * @var string
     */
    private $cryptoName;



    /**
     * Get the value of cryptoName
     *
     * @return  string
     */ 
    public function getCryptoName(): string
    {
        return $this->cryptoName;
    }

    /**
     * Set the value of cryptoName
     *
     * @param  string  $cryptoName
     */ 
    public function setCryptoName(string $cryptoName): void
    {
        $this->cryptoName = $cryptoName;
    }
}
