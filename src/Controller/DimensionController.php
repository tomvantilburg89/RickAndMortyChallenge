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
    public function dimensions(): Response
    {
        $location = $this->location->get();
        $dimensions = [];

        for ($i = 1; $i < $location->info->pages; $i++) {
            foreach ($this->location->page($i) as $result) {
                if (empty($result->residents) || $result->dimension === 'unknown') {
                    continue;
                }
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
                'name' => strtolower((new AsciiSlugger('en'))->slug($dimension->dimension)->toString())
            ]);
        }

        // Get all resident Ids
        $residentIds = $this->location->mapData($dimension);

        // Get all residents inside current location
        $residents = $this->character->get(...$residentIds);

        return $this->render('dimensions/search.html.twig', [
            'title' => $dimension->dimension,
            'location' => $dimension,
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

        if (!$this->isCsrfTokenValid('search_dimension', $csrf_token)) {
            return $this->redirectToRoute('route_404', [
                'name' => 'Access denied'
            ], 403);
        }

        $name = $request->get('search');
        $dimension = $this->location->dimension($name);

        if ($this->location->hasError()) {
            return $this->redirectToRoute('route_404', [
                'name' => strtolower((new AsciiSlugger('en'))->slug($name)->toString())
            ]);
        }
        return $this->redirectToRoute('dimensionShow', [
            'id' => $dimension->id
        ], 301);
    }
}
