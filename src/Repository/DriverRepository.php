<?php

namespace App\Repository;

use App\Entity\Driver;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Driver>
 *
 * @method Driver|null find($id, $lockMode = null, $lockVersion = null)
 * @method Driver|null findOneBy(array $criteria, array $orderBy = null)
 * @method Driver[]    findAll()
 * @method Driver[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DriverRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Driver::class);
    }

   /**
    * @param string $date
    * @param string $license
    *
    * @return Driver[] Returns an array of Driver objects
    */
    public function findByDateAndLicense(string $date, string $license): array
    {
        return $this->createQueryBuilder('d')
            ->leftJoin('d.trips', 't')
            ->andWhere('t.date != :date OR t.date IS NULL')
            ->andWhere('d.license = :license')
            ->setParameter('date', $date)
            ->setParameter('license', $license)
            ->getQuery()
            ->getResult()
        ;
    }
}
