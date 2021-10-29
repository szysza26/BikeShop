<?php

declare(strict_types=1);

namespace App\DTO\Bike;

use Symfony\Component\HttpFoundation\RequestStack;

class GetBikeListRequest
{
    private $page;
    private $count;
    private $category;

    public function __construct(RequestStack $requestStack)
    {
        $request = $requestStack->getCurrentRequest();

        $this->page = (int) $request->query->get('page', 1);
        if($this->page < 1) $this->page = 1;
        $this->count = (int) $request->query->get('count', 12);
        if($this->count < 1) $this->count = 12;

        $this->category = $request->query->get('category');
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }
}