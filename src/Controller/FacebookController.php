<?php

namespace App\Controller;


use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class FacebookController extends AbstractController
{
    // #[Route('/login', name: 'app_login')]
    // public function index(): Response
    // {
    //     return $this->render('facebook/index.html.twig');
    // }

    // #[Route('/logout', name: 'app_logout')]
    // public function logout()
    // {
    //     throw new \Exception('Don\'t forget to activate logout in security.yaml');
    // }


    // Link to this controller to start the "connect" process
    #[Route('/connect/facebook', name: 'connect_facebook')]
    public function connectAction(ClientRegistry $clientRegistry): RedirectResponse
    {
        //Redirect to facebook
        return $clientRegistry
        // key used in config/packages/knpu_oauth2_client.yaml
        ->getClient('facebook')
        // the scopes you want to access
        ->redirect(['public_profile', 'email'], []);
    }

    /**
     * After going to facebook, you're redirected back here
     * because this is the "redirect_route" you configured
     * in config/packages/knpu_oauth2_client.yaml
     */
    #[Route('/connect/facebook/check', name: 'connect_facebook_check')]
    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry)
    {
        // ** if you want to *authenticate* the user, then
        // leave this method blank and create a Guard authenticator

    //     $client = $clientRegistry->getClient('facebook');

    //     try {
    //         // the exact class depends on which provider you're using
    //         /** @var \League\OAuth2\Client\Provider\FacebookUser $user */
    //         $user = $client->fetchUser();

    //         // do something with all this new power!
    //         // e.g. $name = $user->getFirstName();
    //         var_dump($user); die;
    //         // ...
    //     } catch (IdentityProviderException $e) {
    //         // something went wrong!
    //         // probably you should return the reason to the user
    //         var_dump($e->getMessage()); die;
    //     }
    }
}
