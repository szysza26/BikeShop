<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\News;
use App\DTO\NewsDetails;
use App\DTO\NewsInList;
use App\Repository\NewsRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NewsService
{
    private $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getNewsById(int $id): NewsDetails
    {
        $news = $this->newsRepository->find($id);

        if($news == null) throw new NotFoundHttpException();

        $news_dto = new NewsDetails($news);

        return $news_dto;
    }

    public function getAllNews(): array
    {
        $news = $this->newsRepository->findAll();

        $news_dto = array_map(function(News $news){
            return new NewsInList($news);
        }, $news);

        return $news_dto;
    }
}