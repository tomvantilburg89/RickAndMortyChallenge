<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Character;
use App\Service\ChuckNorris;
use App\Service\Episode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

class EpisodeController extends AbstractController
{
    public function __construct(
        private readonly Episode $episode,
        private readonly Character $character
    ) {
    }

    /**
     * Renders the index page for all episodes.
     *
     * @param int|null $page The page number
     * @return Response The response object
     */
    #[Route('/episodes/{page?}', name: 'episodes')]
    public function index(?int $page): Response
    {
        $episodes = $this->episode->page($page);
        // If episode page returns error we just want to redirect to the episodes main page
        if ($episodes->error ?? null) {
            return $this->redirectToRoute('route_404', ['title' => "Page: /episodes/$page does not exist"]);
        }

        return $this->render('episodes/index.html.twig', [
            'title' => 'Episodes',
            'episodes' => $episodes,
            'pagination' => $this->episode->getPagination()
        ]);
    }

    /**
     * Renders the episode page.
     *
     * @param int $id The episode id
     * @return Response The response object
     */
    #[Route('/episode/{id}', name: 'episodeShow')]
    public function show(int $id): Response
    {
        $episode = $this->episode->get($id);

        if ($this->episode->hasError()) {
            return $this->redirectToRoute('route_404', [
                'name' => strtolower((new AsciiSlugger('en'))->slug($episode->name)->toString())
            ]);
        }

        // Get all character Ids
        $characterIds = $this->episode->mapData($episode, 'characters');
        // Get all characters inside current episode
        $characters = $this->character->get(...$characterIds);


        return $this->render('episodes/show.html.twig', [
            'title' => $episode->name,
            'episode' => $episode,
            'characters' => $characters
        ]);
    }
}
