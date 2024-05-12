<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ChuckNorris;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PageController extends AbstractController
{
    public function __construct(
        private readonly ChuckNorris $chuckNorris
    )
    {
    }

    /**
     * Renders the homepage.
     *
     * @return Response The rendered homepage.
     */
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('pages/home.html.twig', [
            'title' => 'Homepage',
            'body' => [
                [
                    'h' => 'Welcome at the Bax Music: Rick and Morty Challenge',
                    'p' => [
                        $this->chuckNorris->joke('Tom van Tilburg'),
                        $this->chuckNorris->joke('Rick Sanchez'),
                        $this->chuckNorris->joke('Morty Smith'),

                    ]
                ],
            ]
        ]);
    }

    /**
     * Renders the 404 page.
     *
     * @param Request $request The request object.
     * @param string|null $name The name parameter.
     * @return Response The rendered 404 page.
     */
    #[Route('/not-found/{name?}', name: 'route_404')]
    public function notFound(Request $request, ?string $name)
    {
        return $this->render('pages/404.html.twig', [
            'title' => "Not found: " . $request->getSession()->get('404_title'),
            'message' => $this->chuckNorris->get()->value,
        ]);
    }
}
