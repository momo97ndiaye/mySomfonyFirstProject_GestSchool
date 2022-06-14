<?php

namespace App\Controller;

use App\Entity\AC;
use App\Form\AcFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AcController extends AbstractController
{
    #[Route('/ac/ajout', name: 'app_ac')]
    public function ajouterAc(Request $request, EntityManagerInterface $EntityManager,UserPasswordHasherInterface $passwordHasher): Response
    {
        $ac = new AC;
        $form = $this->createForm(AcFormType::class,$ac);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $password = $ac->getPassword();
            //dd($ac->getPassword());
            $passHash = $passwordHasher->hashPassword($ac,$password);
            //dd($passHash);
            $ac->setPassword($passHash);
            $ac->setRoles(['ROLE_AC']);
            $EntityManager->persist($ac);
            $EntityManager->flush();
            
        }
        return $this->render('ac/ajout.ac.html.twig', [
            "formAc"=>$form->createView(),
        ]);
    }
}
