<?php

namespace App\Repository;

use App\Entity\ProviderHotelPrix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Mapping\Id;

/**
 * @method ProviderHotelPrix|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProviderHotelPrix|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProviderHotelPrix[]    findAll()
 * @method ProviderHotelPrix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProviderHotelPrixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProviderHotelPrix::class);
    }

    // /**
    //  * @return ProviderHotelPrix[] Returns an array of ProviderHotelPrix objects
    //  */
    


    public function findByPrix($hot){
        return $this->createQueryBuilder('c')
        ->where('c.providerhotels = :val')
        ->setParameter('val', $hot)
        ->getQuery()
        ->getResult();
    }
    
    public function apiFindAll($id)
    {
        return $this->createQueryBuilder('p')
            ->select('p.date,p.prix')
            ->where('p.providerhotels = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?ProviderHotelPrix
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
