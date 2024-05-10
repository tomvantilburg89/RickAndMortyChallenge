<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Api;
use App\Service\Character;
use NickBeen\RickAndMortyPhpApi\Enums\Gender;
use NickBeen\RickAndMortyPhpApi\Enums\Status;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RickAndMortyApiController extends AbstractController
{
    #[Route('/api')]
    public function api(
        Api $api
    ): Response {
        dd($api->get());
    }

    #[Route('/api/character')]
    public function character(
        Character $character
    ) {
        dd(
            $character
                ->withGender(Gender::Male)
                ->withName('Rick')
                ->withStatus(Status::Alive)
                ->get(),

            $character
                ->page(2)
                ->get()
        );
    }
}
