<?php

namespace App\Service;

use App\RickAndMorty\ApiClient;
use App\RickAndMorty\Interfaces\CharacterInterface;
use Symfony\Component\String\UnicodeString;

/**
 * Class Location
 *
 * This class represents a service for interacting with the Location resource in the Rick and Morty API.
 * It extends the ApiClient class and implements the LocationInterface.
 */
class Character extends ApiClient implements CharacterInterface
{
}