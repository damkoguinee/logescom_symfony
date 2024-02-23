<?php

namespace App\Repository;

use App\Entity\Stock;
use App\Entity\Inventaire;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Stock>
 *
 * @method Stock|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stock|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stock[]    findAll()
 * @method Stock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stock::class);
    }

//    /**
//     * @return Stock[] Returns an array of Stock objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Stock
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    /**
     * @return array
     */
    public function findStocksPaginated($magasin, $search, int $pageEnCours, int $limit): array
    {
        $limit = abs($limit);
        $result = [];
        $query = $this->createQueryBuilder('s')
            ->leftJoin('s.product', 'p')
            ->leftJoin('p.categorie', 'c')
            ->Where('s.stockProduit = :stock ')
            ->andWhere('s.quantite != 0')
            ->andWhere('p.statut = \'actif\'')
            ->andwhere('p.reference LIKE :search OR p.designation LIKE :search OR c.nameCategorie LIKE :search ')
            ->setParameter('stock', $magasin)
            ->setParameter('search', '%' . $search . '%')
            ->orderBy('p.designation', 'ASC')
            ->setMaxResults($limit)
            ->setFirstResult(($pageEnCours * $limit) - $limit);
        $paginator = new Paginator($query);
        $data = $paginator->getQuery()->getResult();
        // on calcule le nombre des pages

        $nbrePages = ceil($paginator->count() / $limit);
         // on remplit le tableau
        
         $result['data'] = $data;
         $result['nbrePages'] = $nbrePages;
         $result['pageEncours'] = $pageEnCours;
         $result['limit'] = $limit;
         
        return $result;
    }

    /**
     * @return array
     */
    public function findStocksForApproInitPaginated($magasin, $search, int $pageEnCours, int $limit): array
    {
        $limit = abs($limit);
        $result = [];
        $query = $this->createQueryBuilder('s')
            ->leftJoin('s.product', 'p')
            ->leftJoin('p.categorie', 'c')
            ->Where('s.stockProduit = :stock ')
            ->andWhere('p.statut = \'actif\'')
            ->andwhere('p.reference LIKE :search OR p.designation LIKE :search OR c.nameCategorie LIKE :search ')
            ->setParameter('stock', $magasin)
            ->setParameter('search', '%' . $search . '%')
            ->orderBy('s.quantite', 'ASC')
            ->setMaxResults($limit)
            ->setFirstResult(($pageEnCours * $limit) - $limit);
        $paginator = new Paginator($query);
        $data = $paginator->getQuery()->getResult();
        // on calcule le nombre des pages

        $nbrePages = ceil($paginator->count() / $limit);
         // on remplit le tableau
        
         $result['data'] = $data;
         $result['nbrePages'] = $nbrePages;
         $result['pageEncours'] = $pageEnCours;
         $result['limit'] = $limit;
         
        return $result;
    }


    /**
     * @return array
     */
    public function findProductsPaginated($inventaire, $magasin, $search, int $pageEnCours, int $limit): array
    {
        $limit = abs($limit);
        $result = [];
        $query = $this->createQueryBuilder('s')
            ->select('s as entity', 'i.id as id_inv', 'i.ecart', 'i.quantiteInv as qtite_inv', 'i.statut')
            ->leftJoin(Inventaire::class, 'i', 'WITH', 'i.product = s.product')
            ->leftJoin('s.product', 'p')
            ->leftJoin('p.categorie', 'c')
            ->where('p.reference LIKE :search OR p.designation LIKE :search OR c.nameCategorie LIKE :search ')
            ->andWhere('s.stockProduit = :stock')
            ->andWhere('p.statut = \'actif\'')
            ->andWhere('i.stock = :stock OR i.id IS NULL')
            ->andWhere('i.inventaire = :inventaire OR i.id IS NULL')
            ->setParameter('search', '%' . $search . '%')
            ->setParameter('stock', $magasin)
            ->setParameter('inventaire', $inventaire)
            ->addOrderBy('i.id', 'ASC')
            ->addOrderBy('p.designation', 'ASC')
            ->setMaxResults($limit)
            ->setFirstResult(($pageEnCours * $limit) - $limit);
        $paginator = new Paginator($query);
        $data = $paginator->getQuery()->getResult();
        // on calcule le nombre des pages

        $nbrePages = ceil($paginator->count() / $limit);
         // on remplit le tableau
        
         $result['data'] = $data;
         $result['nbrePages'] = $nbrePages;
         $result['pageEncours'] = $pageEnCours;
         $result['limit'] = $limit;
         
        return $result;
    }

    
}
