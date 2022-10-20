<?php

namespace App\Service;

use App\Entity\Post;

interface AntiSpamServiceInterface
{
    /**
     * Check if a given post contains forbidden words
     *
     * @param Post $post
     * @return Bool
     */
    public function verify(Post $post): bool;
}