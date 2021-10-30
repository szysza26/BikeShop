<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Bike\BikeDetails;
use App\DTO\Bike\BikesInList;
use App\DTO\Bike\GetBikeListRequest;
use App\DTO\Paginate;
use App\Entity\Bike;
use App\Repository\BikeRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BikeService
{
    private $bikeRepository;

    public function __construct(BikeRepository $bikeRepository)
    {
        $this->bikeRepository = $bikeRepository;
    }

    public function getAllBikes(GetBikeListRequest $request): array
    {
        $bikes = $this->bikeRepository->findByFilters([
            "offset" => ($request->getPage() - 1) * $request->getCount(),
            "count" => $request->getCount(),
            "category" => $request->getCategory()
        ]);

        $totalCount = $this->bikeRepository->countByFilters([
            "category" => $request->getCategory()
        ]);

        $bikes_dto = array_map(function(Bike $bike){
            return new BikesInList($bike);
        }, $bikes);

        $bikes_paginate = new Paginate(
            $request->getPage(),
            $request->getCount(),
            (int)ceil($totalCount / $request->getCount())
        );

        return [
            "bikes" => $bikes_dto,
            "paginate" => $bikes_paginate,
            "category" => $request->getCategory()
        ];
    }

    public function getBikeById(int $id): BikeDetails
    {
        $bike = $this->bikeRepository->find($id);

        if($bike == null) throw new NotFoundHttpException();

        $bike_dto = new BikeDetails($bike);

        return $bike_dto;
    }
}