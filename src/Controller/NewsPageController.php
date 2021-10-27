<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\NewsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsPageController extends AbstractController
{
    private $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    /**
     * @Route("/news/page", name="news_page")
     */
    public function index(): Response
    {
        $news = $this->newsService->getAllNews();

        return $this->render('news/index.html.twig', [
            'news' => $news
        ]);
    }
}
