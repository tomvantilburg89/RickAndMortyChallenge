<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\String\UnicodeString;

class LocationController extends AbstractApiController
{
    /**
     * Renders the index page for all locations.
     *
     * @param int|null $page The page number
     * @return Response The response object
     */
    #[Route('/locations/{page?}', name: 'locations')]
    public function index(?int $page): Response
    {
        $locations = $this->location->page($page);

        // If location page returns error we just want to redirect to the locations main page
        if ($locations->error ?? null) {
            return $this->redirectToRoute('route_404', ['title' => "Page: /location/$page does not exist"]);
        }

        return $this->render('locations/index.html.twig', [
            'title' => 'Locations',
            'joke' => $this->chuckNorris->get(),
            'locations' => $locations,
            'pagination' => $this->location->getPagination()
        ]);
    }

    /**
     * Renders the location page.
     *
     * @param int $id The location id
     * @return Response The response object
     */
    #[Route('/location/{id}', name: 'locationShow')]
    public function show(int $id): Response
    {
        $location = $this->location->get($id);

        if ($this->location->hasError()) {
            return $this->redirectToRoute('route_404', [
                'name' => strtolower((new AsciiSlugger('en'))->slug($location->name)->toString())
            ]);
        }

        // get all resident Ids
        $residentIds = $this->location->mapData($location);

        // Get all residents inside current location
        $residents = $this->character->get(...$residentIds);

        return $this->render('locations/show.html.twig', [
            'title' => "Location: $location->name",
            'joke' => $this->chuckNorris->get(),
            'location' => $location,
            'characters' => $residents
        ]);
    }
}
