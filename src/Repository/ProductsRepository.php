<?php

namespace App\Repository;

use App\Entity\Products;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Products>
 *
 * @method Products|null find($id, $lockMode = null, $lockVersion = null)
 * @method Products|null findOneBy(array $criteria, array $orderBy = null)
 * @method Products[]    findAll()
 * @method Products[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Products::class);
    }

//    /**
//     * @return Products[] Returns an array of Products objects
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

//    public function findOneBySomeField($value): ?Products
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

/**
     * @return array
     */
    public function findProductsHomePaginated(int $pageEnCours, int $limit): array
    {
        $limit = abs($limit);
        $result = [];
        $query = $this->createQueryBuilder('a')
            ->setMaxResults($limit)
            ->setFirstResult(($pageEnCours * $limit) - $limit);
        $paginator = new Paginator($query);
        $data = $paginator->getQuery()->getResult();
        // on vérifie qu'on a des données
        // if (empty($data)) {
        //     return $result;
        // }
        // on calcule le nombre des pages

        $nbrePages = ceil($paginator->count() / $limit);
         // on remplit le tableau
        
         $result['data'] = $data;
         $result['nbrePages'] = $nbrePages;
         $result['pageProductsEncours'] = $pageEnCours;
         $result['limit'] = $limit;         
        return $result;
    }

    /**
     * @return array
     */
    public function findProductsPaginated(int $id_categorie, int $pageEnCours, int $limit, ?array $filters_dimensions = null, ?array $filters_epaisseurs = null, ?array $filters_origines = null, ?array $filters_types = null): array
    {
        // dd($filters_dimensions, $filters_epaisseurs, $filters_origines, $filters_types);
        $limit = abs($limit);
        $result = [];
        $query = $this->createQueryBuilder('a')
        ->andWhere('a.categorie = :id_cat')
        ->setParameter('id_cat', $id_categorie);

        if (!empty($filters_dimensions)) {
            $query->andWhere('a.dimension IN (:dimension)')
                ->setParameter('dimension', array_values($filters_dimensions));
        }

        if (!empty($filters_epaisseurs)) {
            $query->andWhere('a.epaisseur IN (:epaisseur)')
                ->setParameter('epaisseur', array_values($filters_epaisseurs));
        }

        if (!empty($filters_origines)) {
            $query->andWhere('a.origine IN (:origine)')
                ->setParameter('origine', array_values($filters_origines));
        }

        if (!empty($filters_types)) {
            $query->andWhere('a.type IN (:type)')
                ->setParameter('type', array_values($filters_types));
        }    
        $query->setMaxResults($limit)
        ->setFirstResult(($pageEnCours * $limit) - $limit);
        $paginator = new Paginator($query);
        $data = $paginator->getQuery()->getResult();
        $nbrePages = ceil($paginator->count() / $limit);
         // on remplit le tableau
        
         $result['data'] = $data;
         $result['nbrePages'] = $nbrePages;
         $result['pageProductsEncours'] = $pageEnCours;
         $result['limit'] = $limit;         
        return $result;
    }
}
