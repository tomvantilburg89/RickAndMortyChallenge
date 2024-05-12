<?php

namespace App\Controller;

use App\Service\Character;
use App\Service\ChuckNorris;
use App\Service\Location;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\AsciiSlugger;

abstract class AbstractApiController extends AbstractController
{

    /**
     * LocationController constructor.
     *
     * @param Location $location The location service
     */
    public function __construct(
        protected readonly Location $location,
        protected readonly Character $character,
        protected readonly ChuckNorris $chuckNorris
    ) {
    }

}