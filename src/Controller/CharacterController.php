<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Character;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

class CharacterController extends AbstractController
{
    public function __construct(
        private readonly Character $character
    ) {
    }

    /**
     * Renders the index page for all locations.
     *
     * @param int|null $page The page number
     * @return Response The response object
     */
    #[Route('/characters/{page?}', name: 'characters')]
    public function index(?int $page): Response
    {
        $characters = $this->character->page($page);

        // If location page returns error we just want to redirect to the locations main page
        if ($locations->error ?? null) {
            return $this->redirectToRoute('route_404', ['title' => "Page: /location/$page does not exist"]);
        }

        return $this->render('characters/index.html.twig', [
            'title' => 'Characters',
            'characters' => $characters,
            'pagination' => $this->character->getPagination()
        ]);
    }

    /**
     * Renders the location page.
     *
     * @param int $id The character id
     * @return Response The response object
     */
    #[Route('/character/{id}', name: 'characterShow')]
    public function show(int $id): Response
    {
        $character = $this->character->get($id);

        if ($this->character->hasError()) {
            return $this->redirectToRoute('route_404', [
                'name' => strtolower((new AsciiSlugger('en'))->slug($character->name)->toString())
            ]);
        }

        return $this->render('characters/show.html.twig', [
            'title' => $character->name,
            'character' => $character,
        ]);
    }
}
