<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Component\Workflow\Registry;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    #[Route('', name: 'app_home')]
    public function index(Request $request, ManagerRegistry $doctrine , PostRepository $postrepo, Registry $registry): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        
       
        //je recupere les posts a afficher sur la page d'acceuil
        $posts = $postrepo->findByStatus("published");
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $post->setUser($user);
            $post->setCurrentState("draft");
            $post->setCreated(new \DateTime());
            if ($picture = $form->get("image")->getData()) {
                $namePicture = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                $namePicture = str_replace(" ", "_", $namePicture);
                $namePicture .= uniqid() . "." . $picture->guessExtension(); 
                $picture->move($this->getParameter("image_post"), $namePicture);
                $post->setImage($namePicture);
            } 
            // Avec cette commande j'applique la transition "to review user" qui permet a l'article de passer de "draft" a "pending" 
            $workflow = $registry->get($post, 'post_publishing');
            $workflow->apply($post, 'to_review_user');

            $entityManager = $doctrine->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
            //$this->addFlash('success', 'Votre post a été créé avec succès !');
    } 
    //dd($posts);
    return $this->render('home/index.html.twig', [
        'controller_name' => 'HomeController',
        'post' => $post,
        'PostType' => $form->createView(),
        'posts' => $posts,
    ]);
    }
}