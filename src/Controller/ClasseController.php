<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClasseController extends AbstractController
{
    #[Route('/classe', name: 'classe')]
    public function lister(/* entityManagerInterface, $ */) : Response
    {
        return $this->render('classe/listerclasse.html.twig', [
            
            "titre"=>"Liste classe"
        ]);
    }
}
