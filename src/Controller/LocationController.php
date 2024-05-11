<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Location;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LocationController extends AbstractController
{
    public function __construct(
        private readonly Location $location,
    ) {
    }

    #[Route('/locations/{page?}')]
    public function index(
        ?int $page
    ): Response {

        $locations = $this->location->getPage($page);

        return $this->render('locations/index.html.twig', [
            'title' => 'Locations',
            'locations' => $locations,
            'pagination' => $this->location->getPagination()
        ]);
    }

    #[Route('/location/{location}')]
    public function location(string $location): Response
    {
        return $this->render('locations/index.html.twig', [
            'data' => $this->location->get()
        ]);
    }

    #[Route('/location/dimension/{dimension?}')]
    public function dimension(
        ?string $dimension
    ) {
        dd($this->location->dimension($dimension));
    }
}
