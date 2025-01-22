<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('page/home.html.twig', [
            'controller_name' => 'Home',
        ]);
    }

    #[Route('/contact', name: 'contact', methods: ['GET', 'POST'])]
    public function contact(): Response
    {
        return $this->render('page/contact.html.twig', [
            'controller_name' => 'Contact',
        ]);
    }

    #[Route('/cgu', name: 'app_cgu', methods: ['GET'])]
    public function cgu(): Response
    {
        return $this->render('page/cgu.html.twig', [
            'controller_name' => 'CGU',
        ]);
    }

    #[Route('/rgpd', name: 'app_rgpd', methods: ['GET'])]
    public function rgpd(): Response
    {
        return $this->render('page/rgpd.html.twig', [
            'controller_name' => 'RGPD',
        ]);
    }
}
