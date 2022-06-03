<?php

namespace App\Controller;

use App\Repository\DemandeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
}
