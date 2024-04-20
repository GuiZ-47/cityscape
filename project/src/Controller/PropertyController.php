<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PropertyController extends AbstractController
{
    // ----------------------- Version sans pagination ------------
    // #[Route('/property', name: 'app_property')]
    // public function index(PropertyRepository $property, EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
    // {   
    //     // Afficher tout les ($property);
    //     // dd($property->findAll());

    //     $properties = $property->filterPropertyByCategory();

    //     return $this->render('property/index.html.twig', [
    //         'Properties' => $property->findAll(),
    //         'breadcrumb_title'=> 'Property',
    //     ]);
    // }

    #[Route('/property/{menu}/{id}-{subMenu}', name: 'app_property')]
    public function index($id, $subMenu, PropertyRepository $property, EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
    {   
        // Afficher tout les ($property);
        // dd($property->findAll());

        $propertiesFiltered = $property->filterPropertyByCategory($id, $subMenu);

        // KNP Paginator
        $pagination = $paginator->paginate(
            $propertiesFiltered, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            9 /*limit per page*/
        );

        // Afficher $pagination
        // dd($pagination);

        return $this->render('property/index.html.twig', [
            'Properties' => $pagination,
            'breadcrumb_title'=> 'Property',
        ]);
    }

    #[Route('/api/react/properties', name: 'api_all_properties')]
    public function allProperties(PropertyRepository $property): JsonResponse
    {   
        // Toute les ($property);
       $properties = $property->findAllPropertiesReact();

        return $this->json($properties);
        // return $properties;
    }

    #[Route('/api/react/property/{Id}', name: 'api_property')]
    public function oneProperty($Id, PropertyRepository $property): JsonResponse
    {   

        
        // Toute les ($property);
        $queryResult = $property->findPropertyByIdReact($Id);
        
        return $this->json($queryResult);


        // return new JsonResponse("Réponse de l'API : Vous avez demandé la propriété avec l'ID : $Id");
    }

} 

