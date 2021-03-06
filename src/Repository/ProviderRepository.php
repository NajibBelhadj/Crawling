<?php

namespace App\Repository;

use App\Entity\Provider;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Provider|null find($id, $lockMode = null, $lockVersion = null)
 * @method Provider|null findOneBy(array $criteria, array $orderBy = null)
 * @method Provider[]    findAll()
 * @method Provider[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProviderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Provider::class);
    }

    /**
      * @return Provider[] Returns an array of Provider objects
    */

    public function apiFindAll() : array
    {
    $qb = $this->createQueryBuilder('a')
        ->select('a.id AS provider_id')
        ->innerJoin('a.providerHotels','p')
        ->addSelect('p.id AS hotel_id','p.name','p.refe')
        ;

    return $qb->getQuery()->getArrayResult();
    }


    /*
    public function findOneBySomeField($value): ?Provider
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
