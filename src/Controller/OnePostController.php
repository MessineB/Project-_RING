<?php

namespace App\Controller;

use DateTime;
use App\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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

        // Grace a l'idée recupéré je recupere le post que je veux afficher 
        $postsactuel = $postrepo->findOneBy(["id" => $idpost]);
        if ($this->isGranted('ROLE_ADMIN')) {
            $commentsactuel = $commentrepo->findAllByPostId($idpost);
        }
        else {
            $commentsactuel= $commentrepo->findByPostId($idpost);
        }
        // Je commence le processus pour créer un nouveau commentaire
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($rq);
        $user = $this->getUser();

        // Lorsque le formulaire est submit et valider
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
                return $this->redirectToRoute('app_onepost', ['id' => $idpost] );
            }
        return $this->render('one_post/index.html.twig', [
            'controller_name' => 'OnePostController',
            'postactuel' => $postsactuel,
            'CommentType' => $form->createView(),
            'comments' => $commentsactuel
        ]);
    }

        //Caché un commentaire
        #[Route('/comment/{idc}/hide', name: 'comment_hide')]
        #[IsGranted("ROLE_ADMIN")]
        public function Commenterhide(Request $rq, ManagerRegistry $doctrine, CommentRepository $commentrepo ) {
            $idcomment = $rq->get("idc");
            $commenttohide = $commentrepo->findById($idcomment);
            $idpost = $commenttohide->getPost()->getId();
            $commenttohide->setstatus("hidden");
            $entityManager = $doctrine->getManager();
            $entityManager->persist($commenttohide);
            $entityManager->flush();
            $this->addFlash('success','Ce commentaire a ete caché avec succes !');
            return $this->redirectToRoute('app_onepost', ['id' => $idpost]);
        }

        //Affiché un commentaire qui etait caché
        #[Route('/comment/{idc}/show', name: 'comment_show')]
        #[IsGranted("ROLE_ADMIN")]
        public function Commentshow(Request $rq, ManagerRegistry $doctrine, CommentRepository $commentrepo ) {
            $idcomment = $rq->get("idc");
            $commenttohide = $commentrepo->findById($idcomment);
            $idpost = $commenttohide->getPost()->getId();
            $commenttohide->setstatus("upload");
            $entityManager = $doctrine->getManager();
            $entityManager->persist($commenttohide);
            $entityManager->flush();
            $this->addFlash('success','Ce commentaire est affiché de nouveau avec succes !');
            return $this->redirectToRoute('app_onepost', ['id' => $idpost]);
        }
         //Supprimer un commentaire.
         #[Route('/comment/{idc}/delete', name: 'comment_delete')]
         #[IsGranted("ROLE_ADMIN")]
         public function Commentdelete(Request $rq, ManagerRegistry $doctrine, CommentRepository $commentrepo ) {
            $idcomment = $rq->get("idc");
            $commenttohide = $commentrepo->findById($idcomment);
            $idpost = $commenttohide->getPost()->getId();
            $entityManager = $doctrine->getManager();
            $entityManager->remove($commenttohide);
            $entityManager->flush();
            $this->addFlash('sucess','Ce commentaire a ete supprimer avec succes !');
            return $this->redirectToRoute('app_onepost', ['id' => $idpost]);
         }
}
