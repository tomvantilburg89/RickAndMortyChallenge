<?php

namespace App\Controller;

use App\Service\Character;
use App\Service\Location;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\AsciiSlugger;

abstract class AbstractApiController extends AbstractController
{
    private object|array $controllerData;

    /**
     * LocationController constructor.
     *
     * @param Location $location The location service
     */
    public function __construct(
        protected readonly Location $location,
        protected readonly Character $character
    ) {
    }

    public function setControllerData(object|array $data)
    {
        $this->controllerData = $data;
    }

    private function getControllerData()
    {
        return $this->controllerData;
    }

    public function show(string $name): Response
    {
        if ($this->location->hasError()) {
            return $this->redirectToRoute('route_404', [
                'name' => strtolower((new AsciiSlugger('en'))->slug($name)->toString())
            ]);
        }

        // Get all residents inside current location
        $residents = $this->character->get(...$this->location->residents());

        return $this->render('locations/show.html.twig', [
            'title' => $name,
            'location' => $this->getControllerData(),
            'residents' => $residents
        ]);
    }
}