<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class MovieController extends AbstractController
{
    #[Route('/movie', name: 'movies')]
    public function index(): Response
    {
        return $this->render('movie/index.html.twig');
    }
}