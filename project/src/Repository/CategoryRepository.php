<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 *
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    // ---------------------------------- requêtes pour l'API React Native -----------------------------------------

    // Récupération de tout les catégories possibles des biens immobiliers
    public function findAllCategoriesReact(): array
    {
        return $this->createQueryBuilder('c')
            // 'c' fais référence à l'entité 'Category'
            // la categorie parent sera nommée 'p' dans la jointure

            // Les Alias dans le SELECT sont les mêmes dans les API de tout les participants au projet, ils servent à harmoniser les clés dans le JSON qui est renvoyé.
            // Pour que tout les participants au projet puissent s'échanger du code sans avoir à l'adapter, malgré des noms de propriétés différentes dans les entités de symfony.
            ->select(
                'c.id AS catId',
                'c.name AS catName',

                'p.id AS catMainCategoryId',
                'p.name AS catMainCategoryName',
                
            )

            // 'On utilise la propriété 'parent' de 'c' pour faire la jointure avec la table 'Category', et y récupérer la catégorie principale 'p' qui est liée à la sous categorie 'c'
            // La méthode join est remplacé par leftJoin pour inclure toutes les catégories, même celles qui n'ont pas de catégories parentes.
            ->leftjoin('c.parent', 'p')

            // Tri des objets
            ->orderBy('c.id')

            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return Category[] Returns an array of Category objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Category
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
