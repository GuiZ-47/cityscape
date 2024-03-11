<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Entity\Picture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\NumericFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;

class PropertyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Property::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural("Propriétés")
            ->setEntityLabelInSingular("une propriété")
            //->setDateFormat('...')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),

            TextField::new('prop_housing_type'),
            // TextEditorField::new('prop_housing_type'),

            // Empêche l'ouverture de l'éditeur
            CollectionField::new('Picture')
                ->setTemplatePath('bundles/EasyAdminBundle/page/picture.html.twig')
                ->useEntryCrudForm()
                // ->setEntryIsComplex()
                // ->setEntryType(PictureType::class)
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(ChoiceFilter::new("prop_housing_type", "Type de propriété")->setChoices([
                "Maison" => "house",
                "Pavillon" => "single_family",
                "Appartement" => "apartment",
                "Bureau" => "office",
                "Villa" => "villa",
                "Luxe" => "luxury_home",
                "Studio" => "studio"
            ]))
            ->add(NumericFilter::new("prop_nb_rooms", "Nombre de chambres"))
            ->add(NumericFilter::new("prop_sqm", "Nombre de mètres carrés"))
            ->add(NumericFilter::new("prop_price", "Prix"))
            ->add(NumericFilter::new("prop_nb_beds", "Nombre de baignoires"))
            ->add(NumericFilter::new("prop_nb_spaces", "Nombre de places de parking"))
            ->add(BooleanFilter::new("prop_furnished", "Meublé ou non ?"))
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL );
    }


}
