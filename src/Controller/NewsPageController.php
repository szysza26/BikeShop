<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\News\GetNewsListRequest;
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
     * @Route("/news", name="news_page_list")
     */
    public function index(GetNewsListRequest $request): Response
    {
        $data = $this->newsService->getAllNews($request);

        return $this->render('news/index.html.twig', [
            'news' => $data["news"],
            'paginate' => $data["paginate"]
        ]);
    }

    /**
     * @Route("/news/{id}", name="news_page_details")
     */
    public function show(int $id): Response
    {
        $news = $this->newsService->getNewsById($id);

        return $this->render('news/show.html.twig', [
            'news' => $news
        ]);
    }
}
