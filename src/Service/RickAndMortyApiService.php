<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class RickAndMortyApiService
{
    protected string $request;
    protected string $apiUri = 'https://rickandmortyapi.com/api';

    /**
     * @param HttpClientInterface $client
     */
    public function __construct(
        private readonly HttpClientInterface $client
    ) {
    }

    /**
     * @param string $name
     * @param int|null $id
     * @return RickAndMortyApiService
     */
    protected function request(string $name, int $id = null): RickAndMortyApiService
    {
        $this->request = is_null($id) ? "$this->apiUri/$name" : "$this->apiUri/$name/$id";
        return $this;
    }

    /**
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    protected function get(): ResponseInterface
    {
        return $this->client->request('GET', $this->request);
    }

    /**
     * @param string|null $id
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    public function getCharacter(string $id = null): ResponseInterface
    {
        return $this->request('character', $id)->get();
    }

    /**
     * @param string|null $id
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    public function getLocation(string $id = null): ResponseInterface
    {
        return $this->request('location', $id)->get();
    }

    /**
     * @param string|null $id
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    public function getEpisode(string $id = null): ResponseInterface
    {
        return $this->request('episode', $id)->get();
    }

}

