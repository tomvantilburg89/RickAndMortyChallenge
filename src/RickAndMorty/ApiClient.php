<?php

namespace App\RickAndMorty;

use App\Traits\HasPagination;
use Doctrine\DBAL\Exception\ServerException;
use ReflectionClass;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class ApiClient
 * 
 * This class is responsible for making API requests to the Rick and Morty API.
 */
class ApiClient
{
    use HasPagination;

    private string $class;
    private ?string $resource;

    private array $query = [];

    /**
     * ApiClient constructor.
     *
     * @param HttpClientInterface $http The HTTP client used to make API requests.
     */
    public function __construct(
        protected readonly HttpClientInterface $http,
    ) {
        $reflectionClass = new ReflectionClass(get_called_class());
        $this->class = $reflectionClass->getName();
        $this->resource = $this->class::URI;
    }

    /**
     * Update the resource URL based on the given ID(s).
     *
     * @param int|null ...$id The ID(s) to be included in the resource URL.
     */
    public function updateResource(?int ...$id): void
    {
        if (!$id) {
            $this->query = [];
        }

        $this->resource = $this->resource . ($id ? '/' . implode(',', $id) : '');
    }

    /**
     * Set a query parameter for the API request.
     *
     * @param string     $key   The query parameter key.
     * @param string|int $value The query parameter value.
     */
    public function setQuery(string $key, string|int $value)
    {
        $this->query[$key] = $value;
    }

    /**
     * Search for characters by name.
     *
     * @param string $name The name of the character.
     * @return object The API response.
     */
    public function name(string $name)
    {
        $this->setQuery('name', $name);
        return $this->get();
    }

    /**
     * Search for characters by dimension.
     *
     * @param string $dimension The dimension of the character.
     * @return object The API response.
     */
    public function dimension(string $dimension)
    {
        return $this->setQuery('dimension', $dimension);
    }

    /**
     * Set the resource URL to the given string.
     *
     * @param string $string The new resource URL.
     * @return object The API response.
     */
    public function uri(string $string): object
    {
        $this->query = [];
        $this->resource = $string;
        return $this->get();
    }

    /**
     * Make a GET request to the API.
     *
     * @param int|null ...$id The ID(s) to be included in the resource URL.
     * @return object The API response.
     */
    public function get(?int ...$id)
    {
        if ($id) {
            $this->updateResource(...$id);
        }

        return json_decode(
            $this->http->request('GET', $this->resource, [
                'query' => $this->query
            ])->getContent(false)
        );
    }
}