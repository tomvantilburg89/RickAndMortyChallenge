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
     * Displays the dimension page.
     *
     * @param Request $request The request object
     * @return Response The response object
     */
    #[Route('dimension', name: 'dimension')]
    public function show(Request $request): Response
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
            return $this->redirectToRoute('dimension', [], 301);
        } else {
            return $this->redirectToRoute('route_404', [
                'name' => 'Access denied'
            ], 403);
        }
    }
}
