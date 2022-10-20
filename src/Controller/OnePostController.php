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
                if (!$user) {
                    $this->addFlash('danger','Vous ne pouvez pas ecrire de commentaire sans etre connecté !');
                    return $this->redirectToRoute('app_login');
                }
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

        //Refuser un post et le mettre en attente de suppression
        #[Route('/comment/{idp}{idc}/hide', name: 'comment_hide')]
        #[IsGranted("ROLE_ADMIN")]
        public function Commentrefused(Request $rq, ManagerRegistry $doctrine, CommentRepository $commentrepo ) {
            $idcomment = $rq->get("idc");
            $commenttohide = $commentrepo->findBy(["id" => $idcomment]);
            $commenttohide[0]->setstatus("hidden");
            $entityManager = $doctrine->getManager();
            $entityManager->persist($commenttohide);
            $entityManager->flush();
            //dd($posttovalidate);
            return $this->redirectToRoute('app_admin');
        }
         //Refuser un post et le mettre en attente de suppression
         #[Route('/comment/{idp}{idc}/delete', name: 'comment_delete')]
         #[IsGranted("ROLE_ADMIN")]
         public function Commentdelete(Request $rq, ManagerRegistry $doctrine, CommentRepository $commentrepo ) {
            $idcomment = $rq->get("idc");
            $commenttohide = $commentrepo->findBy(["id" => $idcomment]);
            $entityManager = $doctrine->getManager();
            $entityManager->delete($commenttohide);
            $entityManager->flush();
            //dd($posttovalidate);
            return $this->redirectToRoute('app_admin');
         }
}
