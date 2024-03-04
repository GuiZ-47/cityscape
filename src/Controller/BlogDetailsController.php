<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BlogDetailsController extends AbstractController
{
    #[Route('/blog/details', name: 'app_blog_details')]
    public function index(): Response
    {
        return $this->render('blog_details/index.html.twig', [
            'controller_name' => 'BlogDetailsController',
            'breadcrumb_title'=> 'Blog Details',
        ]);
    }
}
