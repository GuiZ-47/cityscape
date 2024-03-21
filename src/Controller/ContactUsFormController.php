<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactUsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class ContactUsFormController extends AbstractController
{


    #[Route('/contact/contact-us', name: 'app_contact_us')]
    public function contact(Request $request, EntityManagerInterface $em): Response
    {
        $contact = new Contact();
        // On donne des valeurs par default au nouvel objet, ce qui permet de les afficher dans les champs du formulaire
        $contact->setcontName('Your Name');
        $contact->setcontEmail('Your Email');
        $contact->setContPhoneNumber('Phone Number');
        $contact->setContSubject('Subject');
        $contact->setContMessage('Your Message');

        // Création du formulaire $contactUsForm, de classe "ContactUsType", à partir de $contact  
        $contactUsForm = $this->createForm(ContactUsType::class, $contact, [
            'action' => $this->generateUrl('app_contact_us'),
        ]);

        // Se renseigner plus tard sur le fonctionnemnt des requêtes !!
        $contactUsForm->handleRequest($request);

        // On check si le formulaire est rempli et avec des données valides avant de le traiter
        if ($contactUsForm->isSubmitted()) {
            // $contactUsForm->getData() holds the submitted values
            // but, the original `$contact` variable is also updated
            $contact = $contactUsForm->getData();

            $em->persist($contact);
            $em->flush();

            // ... perform some action, such as saving the task to the database

            return $this->render('_forms/_contact_us_form_success.html.twig');
        }

        // Si le formulaire n'est pas rempli et validé (par exemple au premier affichage de la page), on se contente de l'afficher
        return $this->render('_forms/_contact_us_form.html.twig', [
            'form'=>$contactUsForm,
        ]);

    }
}
