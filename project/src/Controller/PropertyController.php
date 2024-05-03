<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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

    // --------------------------API (il faudrait les déplacer dans un controller à part )------------------------------------
   
    // Sélectionner toute les propriétés avec une seule image pour chacune
    #[Route('/api/react/properties', name: 'api_all_properties')]
    public function allProperties(PropertyRepository $property): JsonResponse
    {   
        // Toute les ($property);
       $properties = $property->findAllPropertiesReact();

        return $this->json($properties);
        // return $properties;
    }

    #[Route('/api/react/properties/new', name: 'api_new_properties')]
    public function findNewestProperty(PropertyRepository $property): JsonResponse
    {   
        // Propriété la plus réçente
       $queryResult = $property->findNewestProperty();

        return $this->json($queryResult);
    }

    // Sélectionner une propriété avec toutes ses images, en fonction d'un Id fourni par la requête
    #[Route('/api/react/property/{Id}', name: 'api_property')]
    public function oneProperty($Id, PropertyRepository $property): JsonResponse
    {   
      
        $queryResult = $property->findPropertyByIdReact($Id);
        
        return $this->json($queryResult);

        // return new JsonResponse("Réponse de l'API : Vous avez demandé la propriété avec l'ID : $Id");
    }

    // Sélectionner toute les catégories
    #[Route('/api/react/categories', name: 'api_all_categories')]
    public function allCategories(CategoryRepository $category): JsonResponse
    {   
        // Toute les ($property);
       $categories = $category->findAllCategoriesReact();

        return $this->json($categories);
        // return $properties;
    }

    // Sélectionner des propriétés filtrées en fonction d'Ids de catégories fourni par la requête, avec une seule image pour chacune des propriété
    #[Route('/api/react/properties/filtered', name: 'api_properties__filtered_by_categories', methods: ['GET'])]
    public function propertiesByCategoryIds(PropertyRepository $property, Request $request): JsonResponse
    {   
        // Récupérer les paramètres de la requête
        $categoryIds = $request->get('categoryIds');
      
        // Pour debug l'API uniquement
        // $categoryIds = ['54','63','66'];
        // var_dump($categoryIds);
        
        // Vérifier si categoryIds est un tableau
        if (!is_array($categoryIds)) {
            return new JsonResponse('categoryIds doit être un tableau');
        };

        $queryResult = $property->findPropertiesByCategoryIds($categoryIds);
        
        return $this->json($queryResult);
        // return $this->json($categoryIds);
    }

    #[Route('api/react/user', name: 'app_user')]
    public function userInfos(TokenStorageInterface $tokenStorage): JsonResponse
    {
        $token = $tokenStorage->getToken();

        $user = $token->getUser();

        return $this->json([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
            'isVerified' => $user->isVerified(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'userName' => $user->getUserName(),
            'createdAt' => $user->getCreatedAt(),
        ]);
    }


    // // Controller d'Iris pour sélectionner des propriétés en fonction de la pagination
    // #[Route('/api/react', name: 'properties', methods: ['GET'])]
    // public function getAllProperties(PropertyRepository $propertyRepo, SerializerInterface $serializer, Request $request): JsonResponse
    // {
    //     $page = $request->get('page', 1);
    //     $limit = $request->get('limit', 3);
    //     $property = $propertyRepo->findAllPropertiesReact($page, $limit);

    //     $jsonProperty = $serializer->serialize($property, 'json', ['groups' => 'getProperty']);

    //     return new JsonResponse($jsonProperty, Response::HTTP_OK, [], true);
    // }

} 

