<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\RickAndMortyApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RickAndMortyApiController extends AbstractController
{
    #[Route('/rick-and-morty-api')]
    public function index(
        RickAndMortyApiService $api
    ): Response
    {
        dd($api->getCharacter()->getContent());
//        return $this->render('rick_and_morty_api/index.html.twig');
    }
}
