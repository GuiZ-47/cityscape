<?php

namespace App\Repository;

use App\Entity\Picture;
use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Property>
 *
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * @return Property[] Returns an array of Property objects
     */
    public function filterPropertyByCategory($id, $subMenu): ?array
    {
        return $this->createQueryBuilder('p')
            ->join('p.Category', 'c')
            ->andWhere('c.id = :id')
            ->setParameter('id', $id)
            ->orderBy('p.prop_price')
            ->getQuery()
            ->getResult()
        ;
    }

// ---------------------------------- requêtes pour l'API React Native -----------------------------------------

    // Récupération de tout les biens immobiliers, une seule image par propriété
    public function findAllPropertiesReact(): array
    {
        return $this->createQueryBuilder('p')
            // 'p' fais référence à l'entité 'Property'
            // la sous-categorie 'sc' et la categorie principale 'c' et les images 'pic' sont issues de jointures avec des entités en relation avec 'Property'

            // Les Alias dans le SELECT sont les mêmes dans les API de tout les participants au projet, ils servent à harmoniser les clés dans le JSON qui est renvoyé.
            // Pour que tout les participants au projet puissent s'échanger du code sans avoir à l'adapter, malgré des noms de propriétés différentes dans les entités de symfony.
            ->select(
                'p.id AS propId',
                'p.propTitle',
                'p.prop_price AS propPrice',
                'p.prop_nb_beds AS propBeds',
                'p.prop_nb_baths AS propBaths',
                'p.propLatitude',
                'p.propLongitude',
                
                'c.id AS catMainCategoryId',
                'c.name AS catMainCategoryName',
                
                'sc.id AS catSubCategoryId',
                'sc.name AS catSubCategoryName',
                
                'pic.id AS picId',
                'pic.imageName AS picName',

                // Renvoie le l'Id max parmi les images 
                // 'MAX(pic.id) AS IdMaxImages',
            )

            // 'On utilise la propriété 'Category' de 'p' pour faire la jointure avec la table 'Category', et y récupérer les sous catégorie 'sc' qui sont liées à chaque biens immobiliers
            ->join('p.Category', 'sc')

            // 'On utilise la propriété 'parent' de 'sc' pour faire la jointure avec la table 'Category', et y récupérer la catégorie principale 'c' qui est liée à la sous categorie 'sc'
            ->join('sc.parent', 'c')
           
            // 'On utilise la propriété 'Picture' de 'p' pour faire la jointure avec la table 'Picture', que l'on nomme 'pic'
            ->innerJoin(
                'p.Picture',
                'pic',
                // Quand il y a plusieurs images, une jointure toute simple créerai un objet par image en retour !! 
                // On se retrouverai donc avec de multiples objets renvoyés concernant un même bien immobilier, pour éviter ça il faut fournir une condition à la jointure :
                // La sous requête DQL va donc permettre de ne récupérer que la première image liée à chaque bien immobilier
                // Cette approche utilise une sous-requête pour sélectionner l'ID de la première image (pic2.id) de chaque propriété (p) et l'utilise comme condition de jointure avec la table des images (Picture).
                'WITH',
                'pic.id = (SELECT MIN(pic2.id) FROM ' . Picture::class . ' pic2 WHERE pic2.property = p)'
            )

            // Solution caca !!! ce bricolage renvoie dans les objets la dernière image de chaque propriété, mais le résultat retourné n'est plus d'un tableau d'objet mais un objet d'objets avec des clés numérotées!!!!!!!!
            // On utilise un indexation par p.id lors de la jointure, ce qui écrase les objets qui ont des noms d'index similaire, pour ne garder que le dernier objet de chaque propriété
            // ->join('p.Picture', 'pic', '', '', 'p.id' )
            
            // Pour alléger les requêtes lors de tests,  on peut ne sélectionner qu'une seule propriété
            // ->andWhere('p.id = :id')
            // ->setParameter('id', 1)
            
            // Tri des objets
            ->orderBy('p.id')

            ->getQuery()
            ->getResult()
        ;
    }

    // Récupération d'un seul bien immobilier sélectionné avec l'Id fourni par la requête. Dans la réponse, un objet est généré par image. 
    public function findPropertyByIdReact($Id): array
    {
        return $this->createQueryBuilder('p')
            // 'p' fais référence à l'entité 'Property'
            // la sous-categorie 'sc' et la categorie principale 'c' et les images 'pic' sont issues de jointures avec des entités en relation avec 'Property'

            // Les Alias dans le SELECT sont les mêmes dans les API de tout les participants au projet, ils servent à harmoniser les clés dans le JSON qui est renvoyé.
            // Pour que tout les participants au projet puissent s'échanger du code sans avoir à l'adapter, malgré des noms de propriétés différentes dans les entités de symfony.
            ->select(
                'p.id AS propId',
                'p.propTitle',
                'p.prop_nb_rooms As propRooms',
                'p.prop_nb_beds AS propBeds',
                'p.prop_nb_baths AS propBaths',
                'p.prop_nb_spaces AS propSpaces',
                'p.prop_sqm AS propArea',
                'p.prop_housing_type AS propType',
                'p.propFeature AS propFeatures',
                
                'p.prop_price AS propPrice',
                'p.propLatitude',
                'p.propLongitude',
                
                'c.id AS catMainCategoryId',
                'c.name AS catMainCategoryName',
                
                'sc.id AS catSubCategoryId',
                'sc.name AS catSubCategoryName',
                
                'pic.id AS picId',
                'pic.imageName AS picName',

                // Renvoie le l'Id max parmi les images 
                // 'MAX(pic.id) AS IdMaxImages',
            )

            // 'On utilise la propriété 'Category' de 'p' pour faire la jointure avec la table 'Category', et y récupérer les sous catégorie 'sc' qui sont liées à chaque biens immobiliers
            ->join('p.Category', 'sc')

            // 'On utilise la propriété 'parent' de 'sc' pour faire la jointure avec la table 'Category', et y récupérer la catégorie principale 'c' qui est liée à la sous categorie 'sc'
            ->join('sc.parent', 'c')
           
            // 'On utilise la propriété 'Picture' de 'p' pour faire la jointure avec la table 'Picture', que l'on nomme 'pic'
            ->innerJoin(
                'p.Picture',
                'pic',
                // Quand il y a plusieurs images, une jointure toute simple créerai un objet par image en retour !! 
                // On se retrouverai donc avec de multiples objets renvoyés concernant un même bien immobilier, pour éviter ça il faut fournir une condition à la jointure :
                // La sous requête DQL va donc permettre de ne récupérer que la première image liée à chaque bien immobilier
                // Cette approche utilise une sous-requête pour sélectionner l'ID de la première image (pic2.id) de chaque propriété (p) et l'utilise comme condition de jointure avec la table des images (Picture).
                // 'WITH',
                // 'pic.id = (SELECT MIN(pic2.id) FROM ' . Picture::class . ' pic2 WHERE pic2.property = p)'
            )
            
            ->andWhere('p.id = :id')
            ->setParameter('id', $Id)
            
            ->getQuery()
            ->getResult()
        ;
    }





    //    /**
//     * @return Property[] Returns an array of Property objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    //    public function findOneBySomeField($value): ?Property
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
