<?php

namespace App\Service ;

use App\Entity\Post;
use App\Service\AntiSpamServiceInterface;

final class AntiSpamService implements AntiSpamServiceInterface
{
    const FORBIDDEN_WORDS = ['merde', 'connasse',  'connard', 'salaud', 'pd', 'pedale' , 'race' ,'pute', 'babtou', 'bamboula' , 'negre' , 'nigger', 'juif','feuje'];

    public function verify(Post $post): bool
    {
        return $this->checkWords($post) && $this->checkPublic($post);
    }

    private function checkWords(Post $post): bool
    {
        foreach ( self::FORBIDDEN_WORDS as $f ) {
            if (  
                str_contains($post->getContent(), $f)  )
            {   
                return false;
            }
        }
        return true;
    }

    public function checkPublic(Post $post): bool 
    {
        foreach ( self::FORBIDDEN_WORDS as $f ) {
            if (  
                str_contains($post->getPublic(), $f)  )
            {   
                return false;
            }
        }
    return true;
    }
    }