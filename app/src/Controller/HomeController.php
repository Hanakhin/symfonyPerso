<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index()
    {
            return $this->render('home/homepage.html.twig',[

            ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about()
    {
        return $this->render('home/about.html.twig');
    }

    #[Route('/permissiondenied', name: 'app_permissiondenied')]
    public function permissiondenied()
    {
        return $this->render('registration/permissiondenied.html.twig');
    }
}
