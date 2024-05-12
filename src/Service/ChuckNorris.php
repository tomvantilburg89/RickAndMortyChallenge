<?php

namespace App\Service;

use App\RickAndMorty\ApiClient;
use App\RickAndMorty\Interfaces\ChuckNorrisInterface;
use App\RickAndMorty\Interfaces\LocationInterface;
use Symfony\Component\String\UnicodeString;

/**
 * Class Location
 *
 * This class represents a service for interacting with the Location resource in the Rick and Morty API.
 * It extends the ApiClient class and implements the LocationInterface.
 */
class ChuckNorris extends ApiClient implements ChuckNorrisInterface
{

}
