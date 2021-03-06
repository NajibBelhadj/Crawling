<?php

namespace App\Repository;

use App\Entity\ProviderHotelImg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProviderHotelImg|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProviderHotelImg|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProviderHotelImg[]    findAll()
 * @method ProviderHotelImg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProviderHotelImgRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProviderHotelImg::class);
    }

    // /**
    //  * @return ProviderHotelImg[] Returns an array of ProviderHotelImg objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProviderHotelImg
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
