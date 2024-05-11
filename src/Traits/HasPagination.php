<?php

namespace App\Traits;

use App\RickAndMorty\ApiClient;

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
        // Set page to query parameters
        $this->query('page', $page ?? 1);

        return $this->results();
    }

    public function getQuery(string $key)
    {
        return $this->query[$key];
    }

    public function results(bool $hasPagination = true): array|object
    {
        if (isset($this->data->error)) {
            return $this->data;
        }

        if ($hasPagination && $this->getInfo('pages') > 1) {
            $this->setPagination();
        }

        return $this->getInfo('count') > 1 ? $this->data->results : $this->data->results[0];
    }

    /**
     * Set the pagination values.
     *
     * @return ApiClient
     */
    private function setPagination(): ApiClient
    {
        $page = $this->getQuery('page');
        $this->total = $this->getInfo('pages');
        $this->next = $page + 1 <= $this->total ? $page + 1 : null;
        $this->prev = $page - 1 >= 1 ? $page - 1 : null;

        return $this;
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
