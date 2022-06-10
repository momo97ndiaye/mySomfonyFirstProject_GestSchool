<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\Inscription;
use App\Form\InscriptionType;
use App\Repository\ClasseRepository;
use App\Repository\EtudiantRepository;
use App\Repository\InscriptionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(ManagerRegistry $doctrine, 
    Request $request): Response
    {
       
        $entityManager = $doctrine->getManager();
        $etudiant = new Inscription;
        $form = $this->createForm(InscriptionType::class,$etudiant);
        dump($request);
        return $this->render('inscription/inscrire.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/add-inscription', name: 'add_inscription')]
    public function add(
    Request $request,
    InscriptionRepository $repo,
    EtudiantRepository $reposit,
    UserPasswordHasherInterface $passwordHasher): Response
    {
            $id=$reposit->findBy([],['id'=>'DESC'])[0]->getId()+1;
            $user = $this->getUser();
            $inscription=new Inscription;
            $etud=new Etudiant;
            $hashedPassword = $passwordHasher->hashPassword(
                $etud,
                "ETUD"
            );
            $etud->setPassword($hashedPassword);
            $etud->setMatricule("MAT--".$id);
            $inscription->setEtudiant($etud);
            $inscription->setAC($user);
            $form = $this->createForm(InscriptionType::class,$inscription);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $name=explode(' ',$inscription->getEtudiant()->getNomComplet());
                $name=strtolower($name[0]);
                $etud->setLogin($name.$id.'@proacedemy.com');
                $repo->add($inscription,true);
                return $this->redirectToRoute('app_inscription');
            }
        return $this->render('inscription/create.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    #[Route('/reinscrire/{id}', name: 'reinscrire')]
    public function reinscrire(
        Request $request,
        InscriptionRepository $repo,
        Inscription $inscription)
        {
                $data=$repo->find($inscription->getId());
               // dd($data);
                $user = $this->getUser();
                $form = $this->createForm(InscriptionType::class,$inscription);
                $form->handleRequest($request);
                $inscription=new Inscription;
                $inscription->setAC($user);
                $inscription->setEtudiant($data->getEtudiant());
                if($form->isSubmitted() && $form->isValid())
                {
                    $repo->add($inscription,true);
                    return $this->redirectToRoute('app_inscription');
                }
            return $this->render('inscription/create.html.twig', [
                'form'=>$form->createView(),
                'editMode'=>$inscription->getId()!==null,
                'data'=>$data
            ]);
        }
}