<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

class DimensionController extends AbstractController
{
    /**
     * Renders the location page.
     *
     * @param string $name The location name
     * @return Response The response object
     */
    #[Route('/dimension/{name}')]

    public function show(string $name): Response
    {
        $this->setControllerData($this->location->dimension($name));

        return parent::show($name);
    }

}
