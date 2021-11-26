<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AfficherUnePageController extends AbstractController
{
    /**
     * @Route("/", name="acceuil")
     */
    public function index(): Response
    {
        return $this->render('afficher_une_page/index.html.twig', [
            'controller_name' => 'Bienvenue sur la page d\'accueil de Prostages',
        ]);
    }
}
