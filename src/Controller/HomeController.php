<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Form\PostType;
use App\Service\AntiSpamService;
use App\Repository\PostRepository;
use App\Service\ImageStorageService;
use Symfony\Component\Workflow\Registry;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    #[Route('', name: 'app_home')]
    public function index(Request $request, ManagerRegistry $doctrine ,PaginatorInterface $paginator, PostRepository $postrepo, Registry $registry, AntiSpamService $antispam, ImageStorageService $imagestorage): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        //je recupere les posts a afficher sur la page d'acceuil
        $postsrecup = $postrepo->findByStatus("published");

        $posts = $paginator->paginate(
            $postsrecup, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4 // Nombre de résultats par page
        );
        
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $post->setUser($user);
            $post->setCurrentState("draft");
            $post->setCreated(new \DateTime());
            if ($picture = $form->get("image")->getData()) {
                $namePicture = $imagestorage->storeimage($picture , "image_post");
                $post->setImage($namePicture);
            } 
            // Avec cette commande je recupere mon workflow dans $workflow 
            $workflow = $registry->get($post, 'post_publishing');


                // Si role est admin
            if ($this->isGranted('ROLE_ADMIN')) {
                $workflow->apply($post, 'publish_admin');
                $this->addFlash('success', 'Votre Article a été créé avec succès !');

                // Si role est verified user
            } else if ($this->isGranted('ROLE_VERIFIED_USER')) {
                $workflow->apply($post, 'to_review_verified_user');
                // Autopending pour verifier des mots pas tres sympa
                $isValid = $antispam->verify($post);
                if(!$isValid) {
                    $workflow->apply($post, 'auto_review_refused');
                    $this->addFlash('danger', 'Votre Article contient des mots qui sont sur la liste des mots proscrit, un admin verifira si votre article merite d\'etre publié. Merci de votre patiente !');
                } else {
                    $workflow->apply($post, 'auto_review_accepted');
                    $this->addFlash('success', 'Votre Article a été créé avec succès !');
                }
            } else {

                //Si ROLE est USER
                $workflow->apply($post, 'to_review_user');
                $this->addFlash('success', 'Votre Article a été créé avec succès ! Veuillez patienter un admin va le verifier puis le publier ');
                $this->addFlash('info', 'Vous pouvez consulter l\'article dans votre Profil.');
            }
            $entityManager = $doctrine->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->redirectToRoute('app_home');
        } 
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'post' => $post,
            'PostType' => $form->createView(),
            'posts' => $posts,
        ]);
    }
}