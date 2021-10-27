<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\News;
use App\DTO\NewsInList;
use App\Repository\NewsRepository;

class NewsService
{
    private $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
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