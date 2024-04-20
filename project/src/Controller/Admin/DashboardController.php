<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use App\Entity\Amenity;
use App\Entity\ArticleBlog;
use App\Entity\BlogCategory;
use App\Entity\Category;
use App\Entity\QuestionResponse;
use App\Entity\User;
use App\Entity\Picture;
use App\Entity\Property;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('bundles/EasyAdminBundle/page/login.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Cityscape');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        
        yield MenuItem::section('Utilisateurs') ;
        yield MenuItem::linkToCrud('Voir les Utilisateurs', 'fa-solid fa-user', User::class);
        yield MenuItem::linkToCrud('Edit Agent with id=2', 'fa-solid fa-user', User::class)
            ->setAction('edit')
            ->setEntityId(2);

        yield MenuItem::section('Propriétés') ;
        yield MenuItem::linkToCrud('Property', 'fa-solid fa-house', Property::class);

        yield MenuItem::section('Images') ;
        yield MenuItem::linkToCrud('Picture', 'fa-regular fa-image', Picture::class);

        yield MenuItem::section('Amenity') ;
        yield MenuItem::linkToCrud('Amenity', 'fa-regular fa-image', Amenity::class);

        yield MenuItem::section('ArticleBlog') ;
        yield MenuItem::linkToCrud('ArticleBlog', 'fa-regular fa-image', ArticleBlog::class);
        
        yield MenuItem::section('Catégories') ;
        yield MenuItem::linkToCrud('BlogCategory', 'fa-regular fa-image', BlogCategory::class);
        yield MenuItem::linkToCrud('Category', 'fa-regular fa-image', Category::class);
    
        yield MenuItem::section('Address') ;
        yield MenuItem::linkToCrud('Address', 'fa-regular fa-image', Address::class);

        yield MenuItem::section('FAQ') ;
        yield MenuItem::linkToCrud('FAQ', 'fa-regular fa-image', QuestionResponse::class);

    }
}
