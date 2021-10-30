<?php

declare(strict_types=1);

namespace App\DTO\Bike;

use App\Entity\Bike;
use App\Entity\BikePhoto;

class BikeDetails
{
    private $id;
    private $name;
    private $description;
    private $price;
    private $count;
    private $photos;
    private $category;

    public function __construct(Bike $bike)
    {
        $this->id = $bike->getId();
        $this->name = $bike->getName();
        $this->description = $bike->getDescription();

        $this->photos = array_map(function(BikePhoto $photo){
            return $photo->getPath();
        }, $bike->getBikePhotos()->toArray());
        if(count($this->photos) == 0) $this->photos[] = "image/bike-riding-gd5cd79bc7_1280.png";

        $this->price = $bike->getPrice();
        $this->count = $bike->getCount();
        $this->category = $bike->getCategory()->getName();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function getCategory(): string
    {
        return $this->category;
    }
}