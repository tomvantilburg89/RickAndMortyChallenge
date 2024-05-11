<?php

namespace App\Service;

use App\Traits\HasPagination;
use NickBeen\RickAndMortyPhpApi\Exceptions\NotFoundException;
use ReflectionClass;
use NickBeen\RickAndMortyPhpApi\Location as RickAndMortyLocation;

use function PHPUnit\Framework\throwException;

class Location extends RickAndMortyLocation
{
    use HasPagination;
}

