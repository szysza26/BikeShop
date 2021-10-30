<?php

declare(strict_types=1);

namespace App\DTO\Bike;

use App\Entity\Bike;

class BikesInList
{
    private $id;
    private $name;
    private $photo;

    public function __construct(Bike $bike)
    {
        $this->id = $bike->getId();
        $this->name = $bike->getName();

        $photos = $bike->getBikePhotos()->toArray();

        if(count($photos) > 0){
            $this->photo = $photos[0]->getPath();
        }else{
            $this->photo = "image/bike-riding-gd5cd79bc7_1280.png";
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }
}