<?php

namespace App\RickAndMorty\Interfaces;

/**
 * Interface LocationInterface
 * 
 * This interface represents the location interface for the Rick and Morty API.
 */
interface ChuckNorrisInterface
{
    /**
     * The base URI for the location API.
     */
    public const URI = 'https://api.chucknorris.io/jokes/random';
}