<?php

namespace App\Controller;

use App\Repository\ProfesseurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
}
