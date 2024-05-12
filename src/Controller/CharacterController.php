<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Character;
use App\Service\Episode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

class CharacterController extends AbstractController
{
    public function __construct(
        private readonly Character $character,
        private readonly Episode $episode
    ) {
    }

    /**
     * Renders the index page for all characters.
     *
     * @param int|null $page The page number
     * @return Response The response object
     */
    #[Route('/characters/{page?}', name: 'characters')]
    public function index(?int $page): Response
    {
        $characters = $this->character->page($page);

        // If character page returns an error, redirect to the characters main page
        if ($characters->error ?? null) {
            return $this->redirectToRoute('route_404', ['title' => "Page: /characters/$page does not exist"]);
        }

        return $this->render('characters/index.html.twig', [
            'title' => 'Characters',
            'characters' => $characters,
            'pagination' => $this->character->getPagination()
        ]);
    }

    /**
     * Renders the character page.
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
        // Get all episode IDs in which the character appears
        $episodeIds = $this->character->mapData($character, 'episode');

        // Get all episodes in which the character appears
        $episodes = $this->episode->get(...$episodeIds);

        return $this->render('characters/show.html.twig', [
            'title' => $character->name,
            'character' => $character,
            'episodes' => $episodes
        ]);
    }
}
