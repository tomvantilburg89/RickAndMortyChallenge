<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LocationController extends AbstractApiController
{
    /**
     * Renders the index page for all locations.
     *
     * @param int|null $page The page number
     * @return Response The response object
     */
    #[Route('/locations/{page?}', name: 'all_locations')]
    public function index(?int $page): Response
    {
        $locations = $this->location->page($page);

        // If location page returns error we just want to redirect to the locations main page
        if ($locations->error ?? null) {
            return $this->redirectToRoute('route_404', ['title' => "Page: /location/$page does not exist"]);
        }

        return $this->render('locations/index.html.twig', [
            'title' => 'Locations',
            'locations' => $locations,
            'pagination' => $this->location->getPagination()
        ]);
    }

    /**
     * Renders the location page.
     *
     * @param string $name The location name
     * @return Response The response object
     */
    #[Route('/location/{name}')]
    public function show(string $name): Response
    {
        $this->setControllerData($this->location->name($name));

        return parent::show($name);
    }
}
