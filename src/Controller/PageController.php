<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('pages/home.html.twig', [
            'title' => 'Homepage',
            'body' => [
                [
                    'h' => 'Welcome at the Bax Music: Rick and Morty Challenge',
                    'p' => [
                        'This challenge was produced by Tom van Tilburg',
                        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sit amet sagittis ante, eleifend accumsan enim. Donec dapibus pulvinar orci efficitur pretium. Integer viverra egestas felis, non bibendum nibh lobortis in. Suspendisse potenti. Morbi pharetra leo ac mi blandit congue. Suspendisse tincidunt iaculis libero sed egestas. Ut tincidunt mattis vulputate. Duis eu pulvinar magna, efficitur lacinia sapien. Sed rutrum mauris justo, eu facilisis libero dignissim ut.',
                        'Ut vitae ultrices dolor. Nulla ultrices convallis pharetra. In molestie faucibus sapien, vel iaculis turpis consequat et. Vivamus condimentum ornare turpis sit amet porttitor. Ut scelerisque ut sapien eget rutrum. Aenean quis faucibus leo. Sed lobortis dolor orci, sit amet cursus lorem viverra eget. Proin efficitur placerat sem, a cursus libero eleifend sed. Pellentesque at turpis justo. Duis ac accumsan arcu.',
                        'Praesent sit amet felis quis diam semper fermentum. Duis ac dapibus justo, id iaculis magna. Vivamus gravida lectus nec vehicula tempus. Integer ut lorem purus. Nam et nibh ante. Quisque tristique turpis nec pulvinar condimentum. Proin feugiat diam vitae ante viverra, ut rhoncus dolor ultricies. Integer sed diam facilisis, efficitur nulla vitae, elementum nibh. Nam mollis eleifend massa eget imperdiet.'

                    ]
                ],
                [
                    'h' => 'Welcome at the Bax Music: Rick and Morty Challenge',
                    'p' => [
                        'This challenge was produced by Tom van Tilburg',
                        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sit amet sagittis ante, eleifend accumsan enim. Donec dapibus pulvinar orci efficitur pretium. Integer viverra egestas felis, non bibendum nibh lobortis in. Suspendisse potenti. Morbi pharetra leo ac mi blandit congue. Suspendisse tincidunt iaculis libero sed egestas. Ut tincidunt mattis vulputate. Duis eu pulvinar magna, efficitur lacinia sapien. Sed rutrum mauris justo, eu facilisis libero dignissim ut.',
                        'Ut vitae ultrices dolor. Nulla ultrices convallis pharetra. In molestie faucibus sapien, vel iaculis turpis consequat et. Vivamus condimentum ornare turpis sit amet porttitor. Ut scelerisque ut sapien eget rutrum. Aenean quis faucibus leo. Sed lobortis dolor orci, sit amet cursus lorem viverra eget. Proin efficitur placerat sem, a cursus libero eleifend sed. Pellentesque at turpis justo. Duis ac accumsan arcu.',
                        'Praesent sit amet felis quis diam semper fermentum. Duis ac dapibus justo, id iaculis magna. Vivamus gravida lectus nec vehicula tempus. Integer ut lorem purus. Nam et nibh ante. Quisque tristique turpis nec pulvinar condimentum. Proin feugiat diam vitae ante viverra, ut rhoncus dolor ultricies. Integer sed diam facilisis, efficitur nulla vitae, elementum nibh. Nam mollis eleifend massa eget imperdiet.'

                    ]
                ],
                [
                    'h' => 'Welcome at the Bax Music: Rick and Morty Challenge',
                    'p' => [
                        'This challenge was produced by Tom van Tilburg',
                        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sit amet sagittis ante, eleifend accumsan enim. Donec dapibus pulvinar orci efficitur pretium. Integer viverra egestas felis, non bibendum nibh lobortis in. Suspendisse potenti. Morbi pharetra leo ac mi blandit congue. Suspendisse tincidunt iaculis libero sed egestas. Ut tincidunt mattis vulputate. Duis eu pulvinar magna, efficitur lacinia sapien. Sed rutrum mauris justo, eu facilisis libero dignissim ut.',
                        'Ut vitae ultrices dolor. Nulla ultrices convallis pharetra. In molestie faucibus sapien, vel iaculis turpis consequat et. Vivamus condimentum ornare turpis sit amet porttitor. Ut scelerisque ut sapien eget rutrum. Aenean quis faucibus leo. Sed lobortis dolor orci, sit amet cursus lorem viverra eget. Proin efficitur placerat sem, a cursus libero eleifend sed. Pellentesque at turpis justo. Duis ac accumsan arcu.',
                        'Praesent sit amet felis quis diam semper fermentum. Duis ac dapibus justo, id iaculis magna. Vivamus gravida lectus nec vehicula tempus. Integer ut lorem purus. Nam et nibh ante. Quisque tristique turpis nec pulvinar condimentum. Proin feugiat diam vitae ante viverra, ut rhoncus dolor ultricies. Integer sed diam facilisis, efficitur nulla vitae, elementum nibh. Nam mollis eleifend massa eget imperdiet.'

                    ]
                ],
                [
                    'h' => 'Welcome at the Bax Music: Rick and Morty Challenge',
                    'p' => [
                        'This challenge was produced by Tom van Tilburg',
                        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sit amet sagittis ante, eleifend accumsan enim. Donec dapibus pulvinar orci efficitur pretium. Integer viverra egestas felis, non bibendum nibh lobortis in. Suspendisse potenti. Morbi pharetra leo ac mi blandit congue. Suspendisse tincidunt iaculis libero sed egestas. Ut tincidunt mattis vulputate. Duis eu pulvinar magna, efficitur lacinia sapien. Sed rutrum mauris justo, eu facilisis libero dignissim ut.',
                        'Ut vitae ultrices dolor. Nulla ultrices convallis pharetra. In molestie faucibus sapien, vel iaculis turpis consequat et. Vivamus condimentum ornare turpis sit amet porttitor. Ut scelerisque ut sapien eget rutrum. Aenean quis faucibus leo. Sed lobortis dolor orci, sit amet cursus lorem viverra eget. Proin efficitur placerat sem, a cursus libero eleifend sed. Pellentesque at turpis justo. Duis ac accumsan arcu.',
                        'Praesent sit amet felis quis diam semper fermentum. Duis ac dapibus justo, id iaculis magna. Vivamus gravida lectus nec vehicula tempus. Integer ut lorem purus. Nam et nibh ante. Quisque tristique turpis nec pulvinar condimentum. Proin feugiat diam vitae ante viverra, ut rhoncus dolor ultricies. Integer sed diam facilisis, efficitur nulla vitae, elementum nibh. Nam mollis eleifend massa eget imperdiet.'

                    ]
                ],
                [
                    'h' => 'Welcome at the Bax Music: Rick and Morty Challenge',
                    'p' => [
                        'This challenge was produced by Tom van Tilburg',
                        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sit amet sagittis ante, eleifend accumsan enim. Donec dapibus pulvinar orci efficitur pretium. Integer viverra egestas felis, non bibendum nibh lobortis in. Suspendisse potenti. Morbi pharetra leo ac mi blandit congue. Suspendisse tincidunt iaculis libero sed egestas. Ut tincidunt mattis vulputate. Duis eu pulvinar magna, efficitur lacinia sapien. Sed rutrum mauris justo, eu facilisis libero dignissim ut.',
                        'Ut vitae ultrices dolor. Nulla ultrices convallis pharetra. In molestie faucibus sapien, vel iaculis turpis consequat et. Vivamus condimentum ornare turpis sit amet porttitor. Ut scelerisque ut sapien eget rutrum. Aenean quis faucibus leo. Sed lobortis dolor orci, sit amet cursus lorem viverra eget. Proin efficitur placerat sem, a cursus libero eleifend sed. Pellentesque at turpis justo. Duis ac accumsan arcu.',
                        'Praesent sit amet felis quis diam semper fermentum. Duis ac dapibus justo, id iaculis magna. Vivamus gravida lectus nec vehicula tempus. Integer ut lorem purus. Nam et nibh ante. Quisque tristique turpis nec pulvinar condimentum. Proin feugiat diam vitae ante viverra, ut rhoncus dolor ultricies. Integer sed diam facilisis, efficitur nulla vitae, elementum nibh. Nam mollis eleifend massa eget imperdiet.'

                    ]
                ],
                [
                    'h' => 'Welcome at the Bax Music: Rick and Morty Challenge',
                    'p' => [
                        'This challenge was produced by Tom van Tilburg',
                        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sit amet sagittis ante, eleifend accumsan enim. Donec dapibus pulvinar orci efficitur pretium. Integer viverra egestas felis, non bibendum nibh lobortis in. Suspendisse potenti. Morbi pharetra leo ac mi blandit congue. Suspendisse tincidunt iaculis libero sed egestas. Ut tincidunt mattis vulputate. Duis eu pulvinar magna, efficitur lacinia sapien. Sed rutrum mauris justo, eu facilisis libero dignissim ut.',
                        'Ut vitae ultrices dolor. Nulla ultrices convallis pharetra. In molestie faucibus sapien, vel iaculis turpis consequat et. Vivamus condimentum ornare turpis sit amet porttitor. Ut scelerisque ut sapien eget rutrum. Aenean quis faucibus leo. Sed lobortis dolor orci, sit amet cursus lorem viverra eget. Proin efficitur placerat sem, a cursus libero eleifend sed. Pellentesque at turpis justo. Duis ac accumsan arcu.',
                        'Praesent sit amet felis quis diam semper fermentum. Duis ac dapibus justo, id iaculis magna. Vivamus gravida lectus nec vehicula tempus. Integer ut lorem purus. Nam et nibh ante. Quisque tristique turpis nec pulvinar condimentum. Proin feugiat diam vitae ante viverra, ut rhoncus dolor ultricies. Integer sed diam facilisis, efficitur nulla vitae, elementum nibh. Nam mollis eleifend massa eget imperdiet.'

                    ]
                ],
            ]
        ]);
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