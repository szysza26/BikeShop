<?php

declare(strict_types=1);

namespace App\DTO;

use App\Entity\News;

class NewsInList
{
    private $title;
    private $description;

    public function __construct(News $news)
    {
        $this->title = $news->getTitle();
        $this->description = $news->getDescription();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}