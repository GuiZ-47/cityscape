<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contName', TextType::class, [
                // On peut attribuer la classe pour le css, ou d'autres attributs des balises HTML
                'attr' => [
                    'placeholder' => 'Your Name',
                    'class' => 'common-input',
                ],
                'label' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your name'
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Your name should be at least {{ limit }} characters ',
                        'max' => 255
                    ]),
                ],
            ])
            ->add('contEmail', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Your Email',
                    'class' => 'common-input',
                ],
                'label' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your email'
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Your email should be at least {{ limit }} characters ',
                        'max' => 255
                    ]),
                ],
            ])
            ->add('contPhoneNumber', TextType::class, [
                'attr' => [
                    'placeholder' => 'Your Phone Number',
                    'class' => 'common-input',
                ],
                'label' => false,
                'constraints' => [
                    // On pourrait insérer ici une expression régulière, par exemple pour les num internationnals : new Regex('/^\\+?[1-9][0-9]{7,14}$/')
                    new Length([
                        'min' => 6,
                        'max' => 255
                    ]),
                ],
            ])
            ->add('contSubject', TextType::class, [
                'attr' => [
                    'placeholder' => 'Subject',
                    'class' => 'common-input',
                ],
                'label' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter the subject'
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Subject should be at least {{ limit }} characters ',
                        'max' => 255
                    ]),
                ],
            ])
            ->add('contMessage', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Write your message',
                    'class' => 'common-input'
                ],
                'label' => false,
            ])
            // Il y a 2 écoles pour le bouton subnmit, ont peut créer un bouton ici ou garder/créer un bouton sur le template HTML
            // Dans le cas de ce projet, le bouton du template fera très bien l'affaire et il est déjà stylisé
            // ->add('save', SubmitType::class, [
            //     // String affiché sur le bouton
            //     'label' => 'Validate',
            //     'attr' => ['class' => 'save'],
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
