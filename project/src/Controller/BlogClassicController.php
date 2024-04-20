<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BlogClassicController extends AbstractController
{
    #[Route('/blog/classic', name: 'app_blog_classic')]
    public function index(): Response
    {
        return $this->render('blog_classic/index.html.twig', [
            'controller_name' => 'BlogClassicController',
            'breadcrumb_title'=> 'Blog Classic',
        ]);
    }
}
