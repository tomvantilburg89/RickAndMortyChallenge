<?php

namespace App\RickAndMorty;

use App\Traits\HasPagination;
use Doctrine\DBAL\Exception\ServerException;
use ReflectionClass;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\String\UnicodeString;
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
    private string $serviceName;
    private ?string $resource;

    private array $query = [];

    private string $queryKey = '';
    private string $queryValue = '';

    private string $mapHook;

    /**
     * ApiClient constructor.
     *
     * @param HttpClientInterface $http The HTTP client used to make API requests.
     */
    public function __construct(
        protected readonly HttpClientInterface $http,
    ) {
        $reflectionClass = new ReflectionClass(get_called_class());
        $this->serviceName = $reflectionClass->getShortName();
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
        $this->query = [];
        $this->queryValue = $value;
        $this->query[$key] = $value;
        $this->setData();
    }

    /**
     * Check if there is an error in the API response.
     *
     * @return bool True if there is an error, false otherwise.
     */
    public function hasError(): bool
    {
        if ($this->data->error ?? null) {
            $session = new Session();
            $title = $this->queryValue;
            $message = "$this->serviceName: $title does not exist";
            $session->set('404_title', $title);
            $session->set('404_message', $message);
            return true;
        }
        return false;
    }

    /**
     * Get the data returned from the API.
     *
     * @return array|object The data returned from the API.
     */
    public function getData(): array|object
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
     * Search by name.
     *
     * @param string $name The name of a character/location.
     * @return array|object The search results.
     */
    public function name(string $name): array|object
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

    /**
     * Map the data returned from the API to an array of IDs.
     *
     * @param object|array $data The data returned from the API.
     * @param string $hook The property name to map.
     * @return array The array of IDs.
     */
    public function mapData(object|array $data, string $hook = 'residents'): array
    {
        $ids = [];
        $this->map($data, $ids, $hook);
        return $ids;
    }

    /**
     * Recursively map the data to extract IDs.
     *
     * @param mixed $array The data to map.
     * @param array $ids The array to store the extracted IDs.
     * @param string $hook The property name to map.
     * @return void
     */
    protected function map($array, array &$ids, string $hook = 'residents'): void
    {
        if (is_array($array)) {
            foreach ($array as $arr) {
                $this->map($arr, $ids);
            }
        } else {
            foreach ($array->{$hook} as $resident) {
                $string = new UnicodeString($resident);
                $ids[] = (int)$string->afterLast('/')->toString();
            }
        }
    }

    /**
     * Get the value of a specific attribute from the API response.
     *
     * @param string|null $attribute The attribute name.
     * @return mixed The value of the attribute, or the entire API response if the attribute is null.
     */
    public function getInfo(?string $attribute): mixed
    {
        return $attribute ?? null ? $this->data->info->{$attribute} : $this->data;
    }

    /**
     * Make a GET request to the API.
     *
     * @param int|null ...$id The ID(s) to be included in the resource URL.
     * @return object The API response.
     */
    public function get(?int ...$id): object|array
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