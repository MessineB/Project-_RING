<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchAdminController extends AbstractController
{
    #[Route('/search/admin', name: 'app_search_admin')]
    public function index(Request $rq, PostRepository $pr): Response
    {
        $word = $rq->get("search");
        $posts= $pr->searchadmin($word);                 
        return $this->render('search_admin/index.html.twig', [
            'controller_name' => 'SearchAdminController',
            'posts' => $posts,
        ]);
    }
}
