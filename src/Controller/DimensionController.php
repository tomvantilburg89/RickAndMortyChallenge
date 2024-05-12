<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

class DimensionController extends AbstractApiController
{
    /**
     * Displays all dimensions.
     *
     * @return Response The response object
     */
    #[Route('/dimensions', name: 'dimensions')]
    public function dimensions()
    {
        $location = $this->location->get();
        $dimensions = [];

        for ($i = 1; $i < $location->info->pages; $i++) {
            foreach ($this->location->page($i) as $result) {
                if (!in_array($result->dimension, $dimensions)) {
                    $dimensions[$result->dimension] = (object)[
                        'name' => $result->dimension,
                        'location' => $result->name,
                        'locationId' => $result->id,
                    ];
                }
            }
        }

        ksort($dimensions);
        return $this->render('dimensions/index.html.twig', [
            'title' => 'Dimensions',
            'dimensions' => $dimensions
        ]);
    }

    /**
     * Displays the dimension page.
     *
     * @return Response The response object
     */
    #[Route('dimension/{id}', name: 'dimensionShow')]
    public function show(int $id): Response
    {
        $dimension = $this->location->get($id);

        if ($this->location->hasError()) {
            return $this->redirectToRoute('route_404', [
                'name' => strtolower((new AsciiSlugger('en'))->slug($dimension->name)->toString())
            ]);
        }

        // Get all resident Ids
        $residentIds = $this->location->mapData($dimension);

        // Get all residents inside current location
        $residents = $this->character->get(...$residentIds);

        return $this->render('locations/show.html.twig', [
            'title' => $dimension->dimension,
            'location' => $dimension,
            'characters' => $residents
        ]);
    }

    /**
     * Displays the dimension page.
     *
     * @param Request $request The request object
     * @return Response The response object
     */
    #[Route('dimension', name: 'dimensionSearchResult')]
    public function searchResult(Request $request): Response
    {
        $name = $request->getSession()->get('dimension');
        $location = $this->location->dimension($name);

        if ($this->location->hasError()) {
            return $this->redirectToRoute('route_404', [
                'name' => strtolower((new AsciiSlugger('en'))->slug($name)->toString())
            ]);
        }

        // Get all resident Ids
        $residentIds = $this->location->mapData($location);

        // Get all residents inside current location
        $residents = $this->character->get(...$residentIds);

        return $this->render('dimensions/search.html.twig', [
            'title' => $name,
            'location' => $location,
            'characters' => $residents
        ]);
    }

    /**
     * Renders the dimension search page.
     *
     * @param Request $request The request object
     * @return Response The response object
     */
    #[Route('/search/dimension', name: 'dimension_search')]
    public function search(Request $request): Response
    {
        $csrf_token = $request->getPayload()->get('token');

        if ($this->isCsrfTokenValid('search_dimension', $csrf_token)) {
            $session = new Session();
            $session->set('dimension', $request->get('search'));
            return $this->redirectToRoute('dimensionSearchResult', [], 301);
        } else {
            return $this->redirectToRoute('route_404', [
                'name' => 'Access denied'
            ], 403);
        }
    }
}
