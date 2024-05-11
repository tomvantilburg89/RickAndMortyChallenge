<?php

namespace App\Service;

use App\RickAndMorty\ApiClient;
use App\RickAndMorty\Interfaces\LocationInterface;

/**
 * Class Location
 * 
 * This class represents a service for interacting with the Location resource in the Rick and Morty API.
 * It extends the ApiClient class and implements the LocationInterface.
 */
class Location extends ApiClient implements LocationInterface
{
}
