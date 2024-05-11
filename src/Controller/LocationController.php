<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Character;
use App\Service\Location;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

class LocationController extends AbstractController
{
    /**
     * LocationController constructor.
     *
     * @param Location $location The location service
     */
    public function __construct(
        private readonly Location $location,
    ) {
    }

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
     * @param Character $character The character service
     * @param string $name The location name
     * @return Response The response object
     */
    #[Route('/location/{name}')]
    public function location(Character $character, string $name): Response
    {
        $location = $this->location->name($name);

        if ($this->location->hasError()) {
            return $this->redirectToRoute('route_404', [
                'name' => strtolower((new AsciiSlugger('en'))->slug($name)->toString())
            ]);
        }

        $residents = $character->get(...$this->location->residents());

        return $this->render('locations/show.html.twig', [
            'title' => $name,
            'location' => $location,
            'residents' => $residents
        ]);
    }

    /**
     * Renders the dimension page.
     * TODO: move to dimension controller
     *
     * @param string|null $dimension The dimension
     */
    #[Route('/location/dimension/{dimension?}')]
    public function dimension(
        ?string $dimension
    ) {
        dd($this->location->dimension($dimension));
    }
}
