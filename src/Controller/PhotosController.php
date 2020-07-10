<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PhotosController extends AbstractController {

    /**
     * @Route("/galerie", name="galerie")
     */
    public function index() {
        return $this->render('photos/index.html.twig');
    }

}
