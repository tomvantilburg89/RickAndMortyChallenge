<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Api;
use App\Service\Character;
use App\Service\Episode;
use App\Service\Location;
use NickBeen\RickAndMortyPhpApi\Enums\Gender;
use NickBeen\RickAndMortyPhpApi\Enums\Status;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApiTestController extends AbstractController
{
    #[Route('/test')]
    public function api(
        Api $api
    ): Response {
        dd($api->get());
    }

    #[Route('/test/characters/{page?}')]
    public function character(
        Character $character,
        ?int $page
    ) {
        dd(
            $character
                ->withGender(Gender::Male)
                ->withName('Rick')
                ->withStatus(Status::Alive)
                ->get(),

            $character
                ->page($page)
                ->get(),
        );
    }

    #[Route('/test/locations/{page?}')]
    public function location(
        Location $location,
        ?int $page,
    ) {
        dd(
            $location->get(),
            $location->page($page)->get()
        );
    }


    #[Route('/test/locations/dimensions/{dimension}/{page?}')]
    public function dimension(
        Location $location,
        string $dimension
    ) {
        dd(
            $location
                ->withDimension("Dimension $dimension")
                ->get()
        );
    }

    #[Route('test/episodes/{page?}')]
    public function episodes(
        Episode $episode,
        ?int $page
    ) {
        dd(
            $episode->get(),
            $episode->page($page)->get()
        );
    }

}
