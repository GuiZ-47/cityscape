<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Entity\Picture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
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
            ->setEntityLabelInSingular("Propriété")
            //->setDateFormat('...')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),

            TextField::new('prop_housing_type', "Type"),
            IntegerField::new('prop_nb_rooms', "Chambres"),
            IntegerField::new('prop_sqm', "Mètres carrés"),
            MoneyField::new('prop_price',"Prix")
            ->setCurrency('EUR')
            ->setStoredAsCents(false)
            ->setNumDecimals(0),
            IntegerField::new('prop_nb_beds', "Lits"),
            IntegerField::new('prop_nb_baths', "Salles de bains"),
            IntegerField::new('prop_nb_spaces', "Places de parking"),
            BooleanField::new('prop_furnished', "Meublé"),
            ArrayField::new("propFeature","Features"),

            CollectionField::new('Picture', 'Images')
                ->setTemplatePath('bundles/EasyAdminBundle/page/picture.html.twig')
                ->useEntryCrudForm()
                ->renderExpanded(),
 
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(ChoiceFilter::new("prop_housing_type", "Type de propriété")->setChoices([
                "Maison" => "Houses",
                "Appartement" => "Apartments",
                "Bureau" => "Office",
                "Villa" => "Villa",
            ]))
            ->add(NumericFilter::new("prop_price"))
            ->add(NumericFilter::new("prop_nb_rooms"))
            ->add(NumericFilter::new("prop_sqm"))
            ->add(NumericFilter::new("prop_nb_beds"))
            ->add(NumericFilter::new("prop_nb_baths"))
            ->add(NumericFilter::new("prop_nb_spaces"))
            ->add(BooleanFilter::new("prop_furnished"))
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL );
    }


}
