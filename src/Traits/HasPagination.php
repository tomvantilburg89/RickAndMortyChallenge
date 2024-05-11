<?php

namespace App\Traits;

trait HasPagination
{
    /**
     * The data returned from the API.
     *
     * @var array|object
     */
    private array|object $data = [];

    /**
     * The total number of pages.
     *
     * @var int|null
     */
    private ?int $total;

    /**
     * The next page number.
     *
     * @var int|null
     */
    private ?int $next;

    /**
     * The previous page number.
     *
     * @var int|null
     */
    private ?int $prev;

    /**
     * Get the data for the specified page.
     *
     * @param int|null $page The page number.
     * @return array|object The data for the specified page.
     */
    public function page(?int $page)
    {
        $this->setQuery('page', $page ?? 1);
        $this->setData($this->get());

        if (isset($this->data->error)) {
            return $this->data;
        }
        $this->setPagination($pageId ?? 1);

        return $this->data->results;
    }

    /**
     * Set the data returned from the API.
     *
     * @param array|object $data The data returned from the API.
     * @return void
     */
    private function setData(array|object $data): void
    {
        $this->data = $data;
    }

    /**
     * Set the pagination values.
     *
     * @param int $page The current page number.
     * @return void
     */
    private function setPagination(int $page): void
    {
        $total = $this->data->info->pages;
        $this->total = $total;
        $this->next = $page + 1 <= $this->total ? $page + 1 : null;
        $this->prev = $page - 1 >= 1 ? $page - 1 : null;
    }

    /**
     * Get the pagination details.
     *
     * @return object The pagination details.
     */
    public function getPagination(): object
    {
        return (object)[
            'pages' => $this->total,
            'next' => $this->next,
            'prev' => $this->prev
        ];
    }
}