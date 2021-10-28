<?php

declare(strict_types=1);

namespace App\DTO;

use App\Entity\News;
use App\Entity\NewsPhoto;

class NewsDetails
{
    private $id;
    private $title;
    private $content;
    private $photos;
    private $createdAt;
    private $modifiedAt;

    public function __construct(News $news)
    {
        $this->id = $news->getId();
        $this->title = $news->getTitle();
        $this->content = stream_get_contents($news->getContent());
        $this->photos = array_map(function(NewsPhoto $photo){
            return $photo->getPath();
        }, $news->getNewsPhotos()->toArray());
        $this->createdAt = $news->getCreatedAt();
        $this->modifiedAt = $news->getModifiedAt();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getModifiedAt(): \DateTimeImmutable
    {
        return $this->modifiedAt;
    }
}