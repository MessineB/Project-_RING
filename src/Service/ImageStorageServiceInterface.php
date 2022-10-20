<?php

namespace App\Service;

use App\Entity\Post;

interface ImageStorageServiceInterface
{
    /**
     * Store image from posts
     *
     * @param Post $post
     * @return string
     */
    public function storeimage($picture): string;
}