<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function listerUser(UserRepository $repo): Response
    {
        $users= $repo->findAll();
        
        return $this->render('user/liste.user.html.twig', [
            'controller_name' => 'UserController',
            "titre"=>"Liste des Utilisateurs",
            "users"=>$users
        ]);
    }
}
