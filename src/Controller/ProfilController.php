<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
    #[Route('/profil/{id}', name: 'app_profil' , methods: ['GET'])]
    public function index(Request $rq, ManagerRegistry $doctrine , PostRepository $postrepo): Response
    {
        $iduser = $rq->get("id");
        $myposts = $postrepo->findByUser($iduser);
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'myposts' => $myposts,
        ]);
    }
}
