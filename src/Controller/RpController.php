<?php

namespace App\Controller;

use App\Entity\RP;
use App\Form\RpFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RpController extends AbstractController
{
    #[Route('/rp/ajout', name: 'app_rp')]
    public function ajouterRp(Request $request, EntityManagerInterface $EntityManager,UserPasswordHasherInterface $passwordHasher): Response
    {
        $rp = new RP;
        $form = $this->createForm(RpFormType::class,$rp);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $password = $rp->getPassword();
            $passHash = $passwordHasher->hashPassword($rp,$password);
            //dd($passHash);
            $rp->setPassword($passHash);
            $rp->setRoles(['ROLE_RP']);
            $EntityManager->persist($rp);
            $EntityManager->flush();

        }
        return $this->render('rp/rp.ajout.html.twig', [
            "formRp"=>$form->createView(),
        ]);
    }
}
