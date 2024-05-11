<?php

namespace App\Traits;


trait HasPagination
{
    private array|object $data = [];
    private ?int $total;
    private ?int $next;
    private ?int $prev;

    public function getPage(?int $pageId): array|object
    {
        $pageId = $pageId ?? 1;
        $data = $this->page($pageId);
        $this->setData($data);
        $this->setPagination($pageId);

        return $this->data->results;
    }

    private function setData(array|object $data): void
    {
        $this->data = $data->get();
    }

    private function setPagination(int $page): void
    {
        $total = $this->data->info->pages;
        $this->total = $total;
        $this->next = $page + 1 <= $this->total ? $page + 1 : null;
        $this->prev = $page - 1 >= 1 ? $page - 1 : null;
    }

    public function getPagination(): object
    {
        return (object)[
            'pages' => $this->total,
            'next' => $this->next,
            'prev' => $this->prev
        ];
    }

}