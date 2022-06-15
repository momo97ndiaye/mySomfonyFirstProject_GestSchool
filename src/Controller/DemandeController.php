<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Form\DemandeFormType;
use App\Repository\DemandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DemandeController extends AbstractController
{
    #[Route('/demande', name: 'app_demande')]
    public function listerDemande(DemandeRepository $repo): Response
    {
        $demandes= $repo->findAll();
/*         dd($demandes);
 */        return $this->render('demande/liste.demande.html.twig', [
            "titre"=>"Liste des Demandes",
            "demandes"=>$demandes
        ]);
    }

    #[Route('/demande/ajout', name: 'app_demande_ajout')]
    public function ajouterModule(Request $request, EntityManagerInterface $EntityManager): Response
    {
        $demande = new Demande;
        $form = $this->createForm(DemandeFormType::class,$demande);
        $form->handleRequest($request);
        $user = $this->getUser();
        $date = new \DateTime('@'.strtotime('now'));
         if ($form->isSubmitted() && $form->isValid()){
            $demande->setEtudiant($user);
            $demande->setDate($date);
            $EntityManager->persist($demande);
            $EntityManager->flush();
            
        }  

        return $this->render('demande/ajout.demande.html.twig', [
            "form"=>$form->createView(),
        ]);
    }


}
