<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseFormType;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/classe/ajout', name: 'app_classe_ajout')]
    public function ajouterModule( Request $request, EntityManagerInterface $EntityManager): Response
    {
        $classe= new Classe();
        $form = $this->createForm(ClasseFormType::class,$classe);
        $form->handleRequest($request); 
        $user = $this->getUser();
        if( $form->isSubmitted() && $form->isValid()){
            $classe->setRp($user);
            //dd($classe);
            $EntityManager->persist($classe);
            $EntityManager->flush();
        }
        
        

        return $this->render('classe/classe.ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
