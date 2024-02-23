<?php

namespace App\Service;

use App\Entity\Vehicle;
use Doctrine\ORM\EntityManagerInterface;

class VehicleService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getVehicleById(int $id): ?Vehicle
    {
        return $this->entityManager->getRepository(Vehicle::class)->find($id);
    }

    public function getAllVehicles(): array
    {
        return $this->entityManager->getRepository(Vehicle::class)->findAll();
    }

    public function createVehicle(array $data): void
    {
        $vehicle = new Vehicle();
        $vehicle->setBrand($data['brand'])
            ->setModel($data['model'])
            ->setPlate($data['plate'])
            ->setLicenseRequired($data['license_required']);

        $this->entityManager->persist($vehicle);
        $this->entityManager->flush();
    }

    public function updateVehicle(Vehicle $vehicle, array $data): void
    {
        $vehicle->setBrand($data['brand'])
            ->setModel($data['model'])
            ->setPlate($data['plate'])
            ->setLicenseRequired($data['license_required']);

        $this->entityManager->flush();
    }

    public function deleteVehicle(Vehicle $vehicle): void
    {
        $this->entityManager->remove($vehicle);
        $this->entityManager->flush();
    }
}
