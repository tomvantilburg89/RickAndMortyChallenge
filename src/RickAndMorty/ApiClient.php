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
    public function setResource(?int ...$id): void
    {
        if (!$id) {
            $this->query = [];
        }

        $this->resource = $this->resource . ($id ? '/' . implode(',', $id) : '');
    }

    /**
     * Set a query parameter for the API request.
     *
     * @param string $key The query parameter key.
     * @param string|int $value The query parameter value.
     */
    public function query(string $key, string|int $value): void
    {
        $this->query[$key] = $value;
        $this->setData();
    }

    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the data returned from the API.
     *
     * @return void
     */
    protected function setData(): void
    {
        $this->data = $this->get();
    }

    /**
     * Search for characters by name.
     *
     * @param string $name The name of the character.
     * @return object|array
     */
    public function name(string $name): object|array
    {
        $this->query('name', $name);
        return $this->results();
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

    public function getInfo(?string $attribute)
    {
        return $attribute ?? null ? $this->data->info->{$attribute} : $this->data;
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
            $this->setResource(...$id);
        }

        return json_decode(
            $this->http->request('GET', $this->resource, [
                'query' => $this->query
            ])->getContent(false)
        );
    }
}