<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
    #[Route('/profil/{id}', name: 'app_profil' , methods: ['GET'])]
    public function index(Request $rq, ManagerRegistry $doctrine , PostRepository $postrepo , UserRepository $userrepo ): Response
    {   
        // Je recupere l'id de l'URL
        $iduser = $rq->get("id");
        // Je recupere les posts fait par l'utilisateur a qui la page profil appartient
        $myposts = $postrepo->findByUser($iduser);

        // Ajout d'une "vue" pour chaque visite d'un utilisateur sur un profil 
        $thisuser = $userrepo->findOneBy(["id" => $iduser]);
        $nbrvue =($thisuser->getNbvue());
        $thisuser->setNbvue($nbrvue + 1);
        
        // Je flush pour changer la base de donnée
        $entityManager = $doctrine->getManager();
        $entityManager->persist($thisuser);
        $entityManager->flush();
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'myposts' => $myposts,
            'thisuser' => $thisuser
        ]);
    }
}
