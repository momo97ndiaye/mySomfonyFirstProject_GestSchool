<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleFormType;
use App\Repository\ModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
    public function ajouterModule(Request $request, EntityManagerInterface $EntityManager): Response
    {
        $module = new Module;
        $form = $this->createForm(ModuleFormType::class,$module);
        $form->handleRequest($request);
        $user = $this->getUser();
        if ($form->isSubmitted() && $form->isValid()){
            

            $EntityManager->persist($module);
            $EntityManager->flush();
        } 

        return $this->render('module/ajout.module.html.twig', [
            "form"=>$form->createView(),
        ]);
    }
}
