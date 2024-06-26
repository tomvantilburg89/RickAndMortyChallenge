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
    public function page(?int $page): array|object
    {
        // Set page to query parameters
        $this->query('page', $page ?? 1);

        return $this->results();
    }

    /**
     * Get the value of a query parameter.
     *
     * @param string $key The query parameter key.
     * @return mixed The value of the query parameter.
     */
    public function getQuery(string $key): mixed
    {
        return $this->query[$key];
    }

    /**
     * Get the results with pagination.
     *
     * @param bool $hasPagination Whether to include pagination.
     * @return array|object The results with pagination.
     */
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
     * @return ApiClient The API client instance.
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
            'current' => $this->query['page'],
            'pages' => $this->total,
            'next' => $this->next,
            'prev' => $this->prev,
        ];
    }
}
