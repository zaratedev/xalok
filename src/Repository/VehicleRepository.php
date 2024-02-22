<?php

namespace App\Repository;

use App\Entity\Vehicle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vehicle>
 *
 * @method Vehicle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicle[]    findAll()
 * @method Vehicle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicle::class);
    }

   /**
    * @param string $date
    * @return Vehicle[] Returns an array of Vehicle objects
    */
    public function findByDate(string $date): array
    {
        return $this->createQueryBuilder('v')
            ->select('v')
            ->leftJoin('v.trips', 't')
            ->andWhere('t.date != :date OR t.date IS NULL')
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult()
        ;
    }
}
