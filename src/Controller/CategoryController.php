<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    #[Route('/movie/{category}', name: 'category')]
    public function show(string $category): Response
    {
        return $this->render('movie/category.html.twig', ['category' => $category]);
    }
}