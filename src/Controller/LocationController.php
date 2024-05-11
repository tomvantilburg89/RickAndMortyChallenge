<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Location;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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
            $this->addFlash('error', $locations->error);
            return $this->redirectToRoute('all_locations', ['page' => 1]);
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
     * @param string $location The location
     * @return Response The response object
     */
    #[Route('/location/{location}')]
    public function location(string $location): Response
    {
        return $this->render('locations/show.html.twig', [
            'data' => $this->location->get()
        ]);
    }

    /**
     * Renders the dimension page.
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
