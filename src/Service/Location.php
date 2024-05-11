<?php

namespace App\Service;

use App\RickAndMorty\ApiClient;
use App\RickAndMorty\Interfaces\LocationInterface;
use Symfony\Component\String\UnicodeString;

/**
 * Class Location
 *
 * This class represents a service for interacting with the Location resource in the Rick and Morty API.
 * It extends the ApiClient class and implements the LocationInterface.
 */
class Location extends ApiClient implements LocationInterface
{
    /**
     * Search for locations by dimension name
     *
     * @param string $name The name of the character.
     * @return object|array
     */
    public function dimension(string $name): object|array
    {
        $this->query('dimension', $name);
        return $this->results();
    }

    public function residents(): array
    {
        $results = $this->results();
        $ids = [];
        $this->mapResidents($results, $ids);
        return $ids;
    }

    private function mapResidents($location, &$residents): void
    {
        if (is_array($location)) {
            foreach ($location as $loc) {
                $this->mapResidents($loc, $residents);
            }
        } else {
            foreach ($location->residents as $resident) {
                $string = new UnicodeString($resident);
                $residents[] = (int)$string->afterLast('/')->toString();
            }
        }
    }

}