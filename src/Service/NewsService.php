<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\News;
use App\DTO\Paginate;
use App\DTO\News\GetNewsListRequest;
use App\DTO\News\NewsDetails;
use App\DTO\News\NewsInList;
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

    public function getAllNews(GetNewsListRequest $request): array
    {
        $filters = [
            "offset" => ($request->getPage() - 1) * $request->getCount(),
            "count" => $request->getCount()
        ];

        $news = $this->newsRepository->findByFilters($filters);

        $news_dto = array_map(function(News $news){
            return new NewsInList($news);
        }, $news);

        $totalCount = $this->newsRepository->countNews();

        $news_paginate = new Paginate(
            $request->getPage(),
            $request->getCount(),
            (int)ceil($totalCount / $request->getCount())
        );

        return [
            "news" => $news_dto,
            "paginate" => $news_paginate
        ];
    }
}