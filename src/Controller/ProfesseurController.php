<?php

namespace App\Controller;

use App\Entity\RP;
use Faker\Factory;
use App\Entity\Professeur;
use App\Form\ProfesseurFormType;
use App\Repository\ProfesseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfesseurController extends AbstractController
{
    #[Route('/professeur', name: 'app_professeur')]
    public function listerProfesseur(ProfesseurRepository $repo): Response
    {
        $profs= $repo->findAll();

        return $this->render('professeur/liste.professeur.html.twig', [
            "titre"=>"Liste des Professeurs",
            "profs"=>$profs
        ]);
    }

    #[Route('/professeur/ajout', name: 'app_professeur_ajout')]
    public function ajouterProfesseur(Request $request, EntityManagerInterface $EntityManager,UserPasswordHasherInterface $passwordHasher): Response
    {
       

        $prof = new Professeur;
        $form = $this->createForm(ProfesseurFormType::class,$prof);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            

            $prof->setRole('ROLE_PROFESSEUR');
            $prof->setRP($rp);
            $EntityManager->persist($prof);
            $EntityManager->flush();
        }
        return $this->render('professeur/ajout.professeur.html.twig', [
            "formProf"=>$form->createView(),
        ]);
    }
}