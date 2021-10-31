<?php

declare(strict_types=1);

namespace App\DTO\Cart;

class SetCartItemRequest
{
    private $bikeId;
    private $quantity;

    public function getBikeId(): ?int
    {
        return $this->bikeId;
    }

    public function setBikeId(?int $bikeId): void
    {
        $this->bikeId = $bikeId;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }
}