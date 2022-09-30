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
    {   // Je recupere l'id du post 
        $idpost = $rq->get("id");

        // Grace a l'idée recupéré je recupere le post que je veux afficher !
        $postsactuel = $postrepo->findOneBy(["id" => $idpost]);
        // Je commence le processus pour créer un nouveau commentaire
        $commentsactuel= $commentrepo->findByPostId($idpost);
    
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($rq);
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid())
            {   
                $comment->setUser($user);
                $comment->setCreated(new DateTime());
               
                $comment->setStatus("upload");
                $comment->setPost($postsactuel);
                
                $entityManager = $doctrine->getManager();
                $entityManager->persist($comment);
                $entityManager->flush();
                $this->addFlash('success','Votre commentaire a eté crée avec succes !');
                return $this->render('one_post/index.html.twig', ['postactuel' => $postsactuel , 'CommentType' => $form->createView() , 'comments' => $commentsactuel] );
            }
        return $this->render('one_post/index.html.twig', [
            'controller_name' => 'OnePostController',
            'postactuel' => $postsactuel,
            'CommentType' => $form->createView(),
            'comments' => $commentsactuel
        ]);
    }
}
