<?php

namespace App\Service;

use App\Entity\Driver;
use Doctrine\ORM\EntityManagerInterface;

class DriverService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getDriverById(int $id): ?Driver
    {
        return $this->entityManager->getRepository(Driver::class)->find($id);
    }

    public function getAllDrivers(): array
    {
        return $this->entityManager->getRepository(Driver::class)->findAll();
    }

    public function createDriver(array $data): void
    {
        $driver = new Driver();

        $driver->setName($data['name'])
            ->setSurname($data['surname'])
            ->setLicense($data['license']);

        $this->entityManager->persist($driver);
        $this->entityManager->flush();
    }

    public function updateDriver(Driver $driver, array $data): void
    {
        $driver->setName($data['name'])
            ->setSurname($data['surname'])
            ->setLicense($data['license']);

        $this->entityManager->flush();
    }

    public function deleteDriver(Driver $driver): void
    {
        $this->entityManager->remove($driver);
        $this->entityManager->flush();
    }
}
