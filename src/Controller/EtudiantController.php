<?php

namespace App\Controller;

use App\Repository\EtudiantRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant', name: 'app_etudiant')]
    public function listerEtudiant(EtudiantRepository $repo): Response
    {
        $etudiants= $repo->findAll();

        return $this->render('etudiant/liste.etudiant.html.twig', [
            'controller_name' => 'EtudiantController',
            "titre"=>"Liste des Étudiants",
            "etudiants"=>$etudiants
        ]);
    }
    #[Route('/etudiant/ajout', name: 'app_etudiant')]
    public function ajouterEtudiant(): Response
    {

        return $this->render('etudiant/ajout.etudiant.html.twig', [
            'controller_name' => 'EtudiantController',
           
        ]);
    }
}
