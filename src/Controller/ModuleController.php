<?php

namespace App\Controller;

use App\Repository\ModuleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModuleController extends AbstractController
{
    #[Route('/module', name: 'app_module')]
    public function listerModule(ModuleRepository $repo): Response
    {
        $modules = $repo->findAll();
        return $this->render('module/liste.module.html.twig', [
            'controller_name' => 'ModuleController',
            "titre"=>"Liste des Modules",
            "modules"=>$modules
        ]);
    }

    #[Route('/module/ajout', name: 'app_module_ajout')]
    public function ajouterModule(): Response
    {
        return $this->render('module/ajout.module.html.twig', [
            'controller_name' => 'ModuleController',
            
        ]);
    }
}
