<?php

namespace App\Controller\Back;

use Exception;
use PHPUnit\Framework\Constraint\ExceptionCode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractController
{
    #[Route('/back/dashboard', name: 'app_back_dashboard')]

    // Pas sur de cette ligne faut revoir la syntax !!!!!!!!!!!!!!!!
    #[IsGranted('ROLE_USER', message: 'Vous devez vous connecter pour accéder à cette page.', statusCode:404, exceptionCode: 404)]
   
    public function index(): Response
    {
        return $this->render('back/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
