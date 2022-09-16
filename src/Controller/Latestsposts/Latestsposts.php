<?php

namespace App\Controller\Latestsposts;

use App\Repository\PostRepository;
use Symfony\Component\Workflow\Registry;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class Latestsposts {

    public function __construct(PostRepository $postrepo) {
        $this->postrepo=$postrepo;
     }

    public function Latestposts() {
        
        $posts = $this->postrepo->findByStatus("published");
        // dd($posts);
        return $posts;
    }
}