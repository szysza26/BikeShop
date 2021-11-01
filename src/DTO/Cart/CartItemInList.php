<?php

declare(strict_types=1);

namespace App\DTO\Cart;

use App\Entity\CartItem;
use JsonSerializable;

class CartItemInList implements JsonSerializable
{
    private $bikeId;
    private $bikeName;
    private $bikePrice;
    private $quantity;

    public function __construct(CartItem $item)
    {
        $this->bikeId = $item->getBike()->getId();
        $this->bikeName = $item->getBike()->getName();
        $this->bikePrice = $item->getBike()->getPrice();
        $this->quantity = $item->getQuantity();
    }

    public function getBikeId(): int
    {
        return $this->bikeId;
    }

    public function getBikeName(): string
    {
        return $this->bikeName;
    }

    public function getBikePrice(): float
    {
        return $this->bikePrice;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function jsonSerialize()
    {
        return [
            "bikeId" => $this->bikeId,
            "bikeName" => $this->bikeName,
            "bikePrice" => $this->bikePrice,
            "quantity" => $this->quantity
        ];
    }
}