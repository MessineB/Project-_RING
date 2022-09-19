<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Component\Workflow\Registry;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{   
    #[Route('/admin', name: 'app_admin')]
    #[IsGranted("ROLE_ADMIN")]
    public function index(Request $request, ManagerRegistry $doctrine ,UserRepository $userrepo , PostRepository $postrepo, Registry $registry): Response
    {   
        $posts = $postrepo->findByStatus("pending");
        $users = $userrepo->findByRole("ROLE_USER");
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'posts' => $posts,
            'users' => $users
        ]);
    }
    #[Route('/post/{id}/pending', name: 'post_pending', methods: ['GET'])]
    #[IsGranted("ROLE_ADMIN")]
    public function postpending(Request $rq,Registry $registry, ManagerRegistry $doctrine, PostRepository $postrepo ) {
        $id = $rq->get("id");
        $posttovalidate = $postrepo->findById($id);
        $workflow = $registry->get($posttovalidate, 'post_publishing');
        $workflow->apply($posttovalidate, 'publish_user');
        $entityManager = $doctrine->getManager();
        $entityManager->persist($posttovalidate);
        $entityManager->flush();
        //dd($posttovalidate);
        return $this->redirectToRoute('app_admin');
    }
    #[Route('/user/{id}/verify', name: 'user_verified', methods: ['GET'])]
    #[IsGranted("ROLE_ADMIN")]
    public function userverify(UserRepository $userrepo ,Request $rq, ManagerRegistry $doctrine ) {
        $id = $rq->get("id");
        $usertovalidate =$userrepo->findOneBy(['id' => $id]);
        $usertovalidate->setRoles(["ROLE_VERIFIED_USER"]);
        $entityManager = $doctrine->getManager();
        $entityManager->persist($usertovalidate);
        $entityManager->flush();
        //dd($usertovalidate);
        return $this->redirectToRoute('app_admin');
    }
}
