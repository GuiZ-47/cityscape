<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    public function __construct(
        private MailerInterface $mailer
    ) {
    }

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {

        $contact = new Contact();

        // Création du formulaire $form, de classe "ContactUsType", à partir de $contact  
        $form = $this->createForm(ContactFormType::class, $contact);

        // // Se renseigner plus tard sur le fonctionnemnt des requêtes !!
        // dd($request);
        $form->handleRequest($request);

        // // On check si le formulaire est rempli et avec des données valides avant de le traiter
        if ($form->isSubmitted() && $form->isValid()) {
            
            // dd($form->getData());
            // dd($form->get('contEmail')->getData())

            // dd ($form->get('contName')->getData());
            $email = (new TemplatedEmail())
                ->from($form->get('contEmail')->getData())
                ->to('toto@toto.toto')
                ->subject($form->get('contSubject')->getData())
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'name'=> $form->get('contName')->getData(),
                    'number'=> $form->get('contPhoneNumber')->getData(),
                    'message'=> $form->get('contMessage')->getData(),
                ]);
            ;


            $this->mailer->send($email);

            $this->addFlash('success', 'Your email has been sent');

            return $this->redirectToRoute('app_contact');

        }

        // Si le formulaire n'est pas rempli et validé (par exemple au premier affichage de la page), on se contente de l'afficher
        return $this->render('contact/index.html.twig', [
            'breadcrumb_title' => 'Contact',
            'form' => $form->createView(),
        ]);

    }
}
