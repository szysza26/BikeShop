<?php

namespace App\Controller;

use App\DTO\Bike\GetBikeListRequest;
use App\Service\BikeService;
use App\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BikesPageController extends AbstractController
{
    private $bikeService;
    private $categoryService;

    public function __construct(BikeService $bikeService, CategoryService $categoryService)
    {
        $this->bikeService = $bikeService;
        $this->categoryService = $categoryService;
    }

    /**
     * @Route("/bikes", name="bikes_page_list")
     */
    public function index(GetBikeListRequest $request): Response
    {
        $data = $this->bikeService->getAllBikes($request);

        $categories = $this->categoryService->categoryList();

        return $this->render('bikes/index.html.twig', [
            'bikes' => $data["bikes"],
            'paginate' => $data["paginate"],
            'category' => $data["category"],
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/bikes/{id}", name="bikes_page_details")
     */
    public function show(int $id): Response
    {
        $bike = $this->bikeService->getBikeById($id);

        return $this->render('bikes/show.html.twig', [
            'bike' => $bike,
        ]);
    }
}
