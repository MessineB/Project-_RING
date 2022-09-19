<?php

namespace App\Controller;

use DateTime;
use App\Entity\Post;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OnePostController extends AbstractController
{
    #[Route('/post/{id}' , name: 'app_onepost') ]
    public function index(Request $rq, ManagerRegistry $doctrine, PostRepository $postrepo , CommentRepository $commentrepo): Response
    {   
        $idpost = $rq->get("id");
        $postsactuel = $postrepo->findOneBy(["id" => $idpost]);
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($rq);
        $user = $this->getUser();
        $commentsactuel = $postsactuel->getComments();
        if ($form->isSubmitted() && $form->isValid())
            {   
                $comment->setUser($user);
                $comment->setCreated(new DateTime());
               
                $comment->setStatus("upload");
                $comment->setPost($postsactuel);
                
                $entityManager = $doctrine->getManager();
                $entityManager->persist($comment);
                $entityManager->flush();
            }

        return $this->render('one_post/index.html.twig', [
            'controller_name' => 'OnePostController',
            'postactuel' => $postsactuel,
            'CommentType' => $form->createView(),
            'comments' => $commentsactuel
        ]);
    }
}
