<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PageController extends AbstractController
{
    #[Route('/')]
    public function index(): Response
    {
        return $this->render('pages/home.html.twig');
    }

    #[Route('/not-found/{name?}', name: 'route_404')]
    public function notFound(Request $request, ?string $name)
    {
        return $this->render('pages/404.html.twig', [
            'title' => $request->getSession()->get('404_title'),
            'message' => $request->getSession()->get('404_message')
        ]);
    }
}