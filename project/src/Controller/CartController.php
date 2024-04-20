<?php

namespace App\Controller;

use Stripe\Stripe;
use App\Entity\Cart;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/cart/add/location/{id}', name: 'app_add_cart')]
    #[IsGranted('ROLE_USER')]
    public function add(SessionInterface $session, $id)
    {
        $panier = $session->get('panier', []);

        if (!empty ($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_show_cart');
    }

    #[Route('/cart/show', name: 'app_show_cart')]
    #[IsGranted('ROLE_USER')]
    public function show(SessionInterface $session, PropertyRepository $propertyRepository): Response
    {
        $panier = $session->get('panier', []);

        $panierWithData = [];

        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'product' => $propertyRepository->find($id),
                'quantity' => $quantity
            ];
        }

        $total = 0;

        foreach ($panierWithData as $item) {
            $totalItem = $item['product']->getPropPrice() * $item['quantity'];
            $total += $totalItem;
        }

        return $this->render('cart/index.html.twig', [
            'items' => $panierWithData,
            'total' => $total,
            'breadcrumb_title' => 'Cart',
        ]);
    }

    #[Route('/cart/remove/location/{id}', name: 'app_remove_cart')]
    #[IsGranted('ROLE_USER')]
    public function remove(SessionInterface $session, $id)
    {
        $panier = $session->get('panier', []);

        if (!empty ($panier[$id])) {
            $panier[$id]--;

            if ($panier[$id] <= 0) {
                unset($panier[$id]);
            }
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_show_cart');
    }

    #[Route('/cart/delete/location/{id}', name: 'app_delete_cart')]
    #[IsGranted('ROLE_USER')]
    public function delete(SessionInterface $session, $id)
    {
        $panier = $session->get('panier', []);

        if (!empty ($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_show_cart');
    }

    // Il y a un delete en trop ici dans le chemin ?
    #[Route('/cart/paiement/stripe', name: 'app_payment')]
    #[IsGranted('ROLE_USER')]
    public function payment(SessionInterface $session, PropertyRepository $propertyRepository): Response
    {
        $sripeSK = $_ENV['STRIPE_SK'];
        Stripe::setApiKey($sripeSK);
 
        $panier = $session->get('panier', []);

        $lineItems = [];
        foreach ($panier as $id => $quantity) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $propertyRepository->find($id)->getPropTitle(),
                    ],
                    // Multiplié par 100 car il faut donner le prix en centimes ? 
                    'unit_amount' => $propertyRepository->find($id)->getPropPrice()*100,
                ],
                'quantity' => $quantity,
            ];
        }

        $session_paiement = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card', 'bancontact', 'ideal', 'sepa_debit'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            // Penser à modifier la redirection en fonction du serveur utilisé ! J'ai du enlever le https et passer sur du http pour faire fonctionner stripe avec le serveur de docker
            'success_url' => 'http://127.0.0.1:8741/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $this->generateUrl('user_panier_show', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        return $this->redirect($session_paiement->url, 303);
    }

    #[Route('/success', name: 'app_success')]
    #[IsGranted('ROLE_USER')]
    public function success(SessionInterface $session, PropertyRepository $property, EntityManagerInterface $entityManager, Request $request): Response
    {   
        $session_id = $request->query->get('session_id');
        $stripe = new \Stripe\StripeClient($_ENV['STRIPE_SK']);
        $session_stripe = $stripe->checkout->sessions->retrieve($session_id);
        $paiement = $stripe->paymentIntents->retrieve($session_stripe->payment_intent);

        $panier = $session->get('panier', []);

        // // je vais faire une boucle pour l'insert dans cart -> un objet enregistré dans la table location pour chaque article
        // foreach ($panier as $id => $quantity) {
        //     $AjoutPanier = new Cart();
        //     $AjoutPanier->setUser($this->getUser());
        //     $AjoutPanier->setStripeId($paiement->id);
        //     $AjoutPanier->addProperty($property->find($id));
        //     $entityManager->persist($AjoutPanier);
        //     $entityManager->flush();
        // }

        // Deuxième méthode plus adaptée à une relation Many To Many entre Cart et Property
        // On boucle uniquement l'ajout des propriétés à l'objet, un seul objet enregistré par pairment, mais contenant tout les articles du panier dans une collection
        $AjoutPanier = new Cart();
        $AjoutPanier->setUser($this->getUser());
        $AjoutPanier->setStripeId($paiement->id);
        foreach ($panier as $id => $quantity) {
            $AjoutPanier->addProperty($property->find($id));
        }
        $entityManager->persist($AjoutPanier);
        $entityManager->flush();

        return $this->render('cart/success.html.twig');
    }

    #[Route('/cart/total/location/delete/location/cancel_url', name: 'user_panier_show')]
    #[IsGranted('ROLE_USER')]
    public function cancel_url(): Response
    {


        return $this->render('cart/cancel_url.html.twig');
    }

}
