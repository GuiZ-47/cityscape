<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactUsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contName', TextType::class,[
                'label'=> 'Nom',
                ])
            ->add('contEmail', EmailType::class,[
                'label'=> 'Email',
                ])
            ->add('contPhoneNumber', TextType::class,[
                'label'=>'Phone Number',
                'required' => false,
            ])
            ->add('contSubject',TextType::class,[
                'label'=> 'Sujet',
                ])
            ->add('contMessage',TextType::class,[
                'label'=> 'Message',
                ])
            ->add('save', SubmitType::class, [
                // String affiché sur le bouton
                'label'=> 'Validate',
                // On peut attribuer ici la classe du bouton pour le css, ou d'autres attributs des balises HTML
                'attr' => ['class' => 'save'],
                'validate'=>false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
