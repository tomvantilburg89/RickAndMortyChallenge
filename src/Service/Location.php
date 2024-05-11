<?php

namespace App\Service;

use NickBeen\RickAndMortyPhpApi\Location as RickAndMortyLocation;

class Location extends RickAndMortyLocation
{
    public function all()
    {

    }

    public function dimension(?string $dimension)
    {
        if ($dimension != null) {
            return $this->withDimension($dimension)->get();
        } else {
            return $this->get();
        }
    }
}

