<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;

class AfficherUnePageController extends AbstractController
{
    /**
     * @Route("/", name="acceuil")
     */
    public function index(): Response
    {
        $repositoryStage=$this->getDoctrine()->getRepository(Stage::class);
        $stages=$repositoryStage->findAll();
        return $this->render('afficher_une_page/index.html.twig', [
            'controller_name' => 'Bienvenue sur la page d\'accueil de Prostages',
            'stages'=>$stages,
        ]);
    }
    /**
     * @Route("/entreprises/{id}", name="entreprises")
     */
    public function indexEntreprise($id): Response
    {   
        $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);
        $entreprise=$repositoryEntreprise->Find($id);
        $titreEntreprise=$entreprise->getNom();
        $repositoryStages=$this->getDoctrine()->getRepository(Stage::class);
        $listeStages=$repositoryStages->FindBy(["entreprise"=>$id]);
        return $this->render('entreprises/index.html.twig', [
            'titreEntreprise'=>$titreEntreprise,
            'listeStages'=>$listeStages,
            
        ]);
    }
    /**
     * @Route("/formations/{id}", name="formations")
     */
    public function indexFormation($id): Response
    {   
        $repositoryFormation = $this->getDoctrine()->getRepository(Formation::class);
        $formation=$repositoryFormation->Find($id);
        $titreFormation=$formation->getNomLong();
        $listeStages=$formation->getStages();
        return $this->render('formations/index.html.twig', [
            'controller_name' => 'Cette page affichera la liste des formations de l\'IUT',
            'titreFormation'=>$titreFormation,
            'listeStages'=>$listeStages
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
     * @Route("/stages/{id}",name="stage_selectionner")
     */
    public function stage_selectionner($id)
    {
        $repositoryStages=$this->getDoctrine()->getRepository(Stage::class);
        $stage=$repositoryStages->FindBy(["stage"=>$id]);
        return $this->render('templates/stages_id/index.html.twig',['Stage'=>$Stage]);
    }
}



