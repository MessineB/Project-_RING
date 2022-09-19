<?php

namespace App\Controller\Latestsposts;

use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Component\Workflow\Registry;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class Latestsposts {

    public function __construct(PostRepository $postrepo , UserRepository $userrepo) {
        $this->postrepo=$postrepo;
        $this->userrepo=$userrepo;
     }

    public function Latestposts() {
        
        $posts = $this->postrepo->findByStatus("published");
        
        // dd($posts);
        return $posts;
    }
    public function PendingPosts() {
        $postspending = $this->postrepo->findByStatus("pending");
        return $postspending;
    }
    public function Usertoverify() {
        $usertov = $this->userrepo->findByRole("ROLE_USER");
        return $usertov;
    }

}