<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddListingController extends AbstractController
{
    #[Route('/add/listing', name: 'app_add_listing')]
    public function index(): Response
    {
        return $this->render('add_listing/index.html.twig', [
            'controller_name' => 'AddListingController',
            'breadcrumb_title'=> 'Add New Listing',
        ]);
    }
}
