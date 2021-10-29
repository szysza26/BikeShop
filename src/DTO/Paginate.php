<?php

declare(strict_types=1);

namespace App\DTO;

class Paginate
{
    private $page;
    private $count;
    private $totalPages;

    public function __construct(int $page, int $count, int $totalPages)
    {
        $this->page = $page;
        $this->count = $count;
        $this->totalPages = $totalPages;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }
}