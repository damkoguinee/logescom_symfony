<?php

namespace App\Repository;

use App\Entity\MouvementProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MouvementProduct>
 *
 * @method MouvementProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method MouvementProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method MouvementProduct[]    findAll()
 * @method MouvementProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MouvementProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MouvementProduct::class);
    }

//    /**
//     * @return MouvementProduct[] Returns an array of MouvementProduct objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MouvementProduct
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
