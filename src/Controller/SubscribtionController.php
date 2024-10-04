<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class SubscribtionController extends AbstractController
{
    #[Route('/subscribe', name: 'subscribe')]
    public function subscribe(): Response
    {
        return $this->render('abonnement.html.twig');
    }
}