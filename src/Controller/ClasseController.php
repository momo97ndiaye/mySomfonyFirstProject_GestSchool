<?php

namespace App\Controller;

use App\Repository\ClasseRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{
    #[Route('/classe', name: 'app_classe')]
    public function lister(ClasseRepository $repo) : Response
    {
        $classes= $repo->findAll();
        return $this->render('classe/listerclasse.html.twig', [
            "titre"=>"Liste des Classes",
            "classes"=>$classes
        ]);
    }
}
