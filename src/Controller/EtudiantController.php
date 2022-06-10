<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Entity\Inscription;
use App\Form\InscriptionType;
use App\Repository\EtudiantRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/etudiant/ajout', name: 'app_etudiant_ajout')]
    public function ajouterEtudiant(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $etudiant = new Etudiant;
        $form = $this->createForm(EtudiantType::class,$etudiant);
        return $this->render('etudiant/ajout.etudiant.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/etudiant/inscrire', name: 'app_etudiant_inscrire')]
    public function inscrireEtudiant(ManagerRegistry $doctrine,Request $request): Response
    {
        $entityManager = $doctrine->getManager();
        $etudiant = new Inscription;
        $form = $this->createForm(InscriptionType::class,$etudiant);
        dump($request);
        return $this->render('etudiant/inscrire.etudiant.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
