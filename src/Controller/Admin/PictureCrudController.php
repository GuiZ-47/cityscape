<?php

namespace App\Controller\Admin;

use App\Entity\Picture;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PictureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Picture::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->hideNullValues()
            ->setEntityLabelInSingular('Image')
            ->setEntityLabelInPlural('Images')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('imageName', "Image Name")
                ->onlyOnIndex(),
            IntegerField::new('image_size')
                ->onlyOnIndex(),
            DateField::new('CreatedAt')
                ->onlyOnIndex(),
            DateField::new('UpdatedAt')
                ->onlyOnIndex(),
            TextField::new('imageFile', '')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),
            ImageField::new('imageName', 'Aperçu des Images')->setBasePath('/assets/images/property')
                ->onlyOnIndex(),
        ];
    }

}
