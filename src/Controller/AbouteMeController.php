<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbouteMeController extends AbstractController
{
    #[Route('/aboute/me', name: 'app_aboute_me')]
    public function index(): Response
    {
        return $this->render('aboute_me/index.html.twig', [
            'controller_name' => 'AbouteMeController',
        ]);
    }
}
