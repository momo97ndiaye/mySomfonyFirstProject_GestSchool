<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\Inscription;
use App\Form\InscriptionType;
use App\Repository\ClasseRepository;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\InscriptionRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\AnneeScolaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(ManagerRegistry $doctrine, Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $EntityManager, AnneeScolaireRepository $anneeRepo): Response
    {
        $entityManager = $doctrine->getManager();
        $ins = new Inscription;
        $form = $this->createForm(InscriptionType::class,$ins);
        $user = $this->getUser();
        $anneescolaire =$anneeRepo->findOneByEtat("En cours");
        //dump($request);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $etudiant=$ins->getEtudiant();
            $password = "passer";
            $passHash = $passwordHasher->hashPassword($etudiant,$password);
            $etudiant->setPassword($passHash);
            $etudiant->setMatricule("Mat001");
            $etudiant->setRoles(['ROLE_ETUDIANT']);
            $ins->setAnneescolaire($anneescolaire);
            $ins->setAC($user);
            $EntityManager->persist($ins);
            $EntityManager->flush();
            $lastId = $etudiant->getId();
            //dd($lastId);
        }
        

        return $this->render('inscription/inscrire.html.twig', [
            'form' => $form->createView(),
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