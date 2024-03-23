<?php

namespace App\Controller\Panier;
use App\Repository\PropertyRepository;
use App\Services\Panier\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class PanierController extends AbstractController
{

    #[Route('api/ajout/panier/{id}', name: 'app_panier')]
    public function index(int $id, SessionInterface $session, PropertyRepository $property)
    {
            $cart = $session->get('panier',[]);
            $cart = $id;

            dd($cart['panier']);

            // $panierWithData


            return $this->render('cart/index.html.twig', [
                'breadcrumb_title'=> 'Panier'
            ]);
    }
    
}
