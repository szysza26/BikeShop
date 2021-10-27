<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BikesPageController extends AbstractController
{
    /**
     * @Route("/bikes/page", name="bikes_page")
     */
    public function index(): Response
    {
        return $this->render('bikes/index.html.twig', [
            'controller_name' => 'BikesPageController',
        ]);
    }
}
