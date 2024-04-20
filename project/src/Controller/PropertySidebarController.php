<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PropertySidebarController extends AbstractController
{
    #[Route('/property/sidebar', name: 'app_property_sidebar')]
    public function index(): Response
    {
        return $this->render('property_sidebar/index.html.twig', [
            'controller_name' => 'PropertySidebarController',
            'breadcrumb_title'=> 'Property With Sidebar',
        ]);
    }
}
