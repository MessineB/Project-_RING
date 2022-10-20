<?php

namespace App\Service ;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ImageStorageService extends AbstractController
{

    public function storeimage($picture , $place)
    {   
        $namePicture = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
        $namePicture = str_replace(" ", "_", $namePicture);
        $namePicture .= uniqid() . "." . $picture->guessExtension(); 
        $picture->move($this->getParameter($place), $namePicture);
        return $namePicture;
    }

    }