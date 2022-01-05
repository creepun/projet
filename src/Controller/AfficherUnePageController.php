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
    /**
     * @Route("/entreprises", name="entreprises")
     */
    public function indexEntreprise(): Response
    {
        return $this->render('entreprises/index.html.twig', [
            'controller_name' => 'Cette page affichera la liste des entreprises proposant un stage',
        ]);
    }
    /**
     * @Route("/formations", name="formations")
     */
    public function indexFormation(): Response
    {
        return $this->render('formations/index.html.twig', [
            'controller_name' => 'Cette page affichera la liste des formations de l\'IUT',
        ]);
    }
    /**
     * @Route("/stages/{id}", name="stages_i_d")
     */
    public function indexStage($id): Response
    {
        return $this->render('stages_id/index.html.twig', 
        ['controller_name' =>$id]);
       
    }
    /**
     * @Route("/entreprises/{id},name=liste_stages_par_entreprise")
     */
    public function liste_stages_par_entreprise($id)
    {
        $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);
        $entreprise=$repositoryEntreprise->Find($id);
        $titreEntreprise=$entreprise->getNom();
        $repositoryStages=$this->getDoctrine()->getRepository(Stage::class);
        $listeStages=$repositoryStages->FindBy(["entreprise"=>$id]);
        return $this->render('templates/entreprises/index.html.twig',['titreEntreprise'=>$titreEntreprise,'listeStages'=>$listeStages]);
    }
}



