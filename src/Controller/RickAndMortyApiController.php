<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ApiService;
use App\Service\RickAndMortyApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RickAndMortyApiController extends AbstractController
{
    #[Route('/{name}/{id?}')]
    public function index(
        RickAndMortyApiService $api,
        string $name,
        int $id = null
    ): Response {
        dd($api->get());
//        dd($api->get() ?? []);
//        return $this->render('rick_and_morty_api/index.html.twig');
    }
}
