<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends AbstractController {

    /**
     * @Route("/projets", name="projects")
     */
    public function index() {
        return $this->render('projects/index.html.twig');
    }

}
