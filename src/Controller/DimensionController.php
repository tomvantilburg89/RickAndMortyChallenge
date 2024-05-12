<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

class DimensionController extends AbstractApiController
{
    /**
     * Renders the location page.
     *
     * @param string $name The location name
     * @return Response The response object
     */
    #[Route('/dimension/{name}')]
    public function show(string $name): Response
    {
        $location = $this->location->dimension($name);

        if ($this->location->hasError()) {
            return $this->redirectToRoute('route_404', [
                'name' => strtolower((new AsciiSlugger('en'))->slug($location[0]->dimension)->toString())
            ]);
        }

        // get all resident Ids
        $residentIds = $this->location->characters($location);

        // Get all residents inside current location
        $residents = $this->character->get(...$residentIds);

        return $this->render('locations/show.html.twig', [
            'title' => $location[0]->dimension,
            'location' => $location,
            'characters' => $residents
        ]);
    }

}
