<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\HttpFoundation\RequestStack;

class GetNewsListRequest
{
    private $page;
    private $count;

    public function __construct(RequestStack $requestStack)
    {
        $request = $requestStack->getCurrentRequest();

        $this->page = (int) $request->query->get('page', 1);
        if($this->page < 1) $this->page = 1;
        $this->count = (int) $request->query->get('count', 5);
        if($this->count < 1) $this->count = 5;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}