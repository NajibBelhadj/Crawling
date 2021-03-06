<?php

namespace App\Repository;

use App\Entity\ProviderHotel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Expr\Value;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProviderHotel|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProviderHotel|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProviderHotel[]    findAll()
 * @method ProviderHotel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProviderHotelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProviderHotel::class);
    }

    public function apiFindAll($id)
    {
        return $this->createQueryBuilder('p')
            ->select('p.providerHotelPrixes')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findPV($value1)
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.provide = 1 AND p.ville = :value1')
            ->setParameter('value1', $value1)
            ->getQuery()
            ->getResult()
            ;
    }
    
   
    /*
    public function findOneBySomeField($value): ?ProviderHotel
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
