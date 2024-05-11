<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Location;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PageController extends AbstractController
{
    #[Route('/')]
    public function index(): Response
    {
        return $this->render('pages/home.html.twig');
    }
}
