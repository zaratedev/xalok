<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private string $brand;

    #[ORM\Column]
    private string $plate;

    #[ORM\Column]
    private string $licenseRequired;

    public function getId(): int
    {
        return $this->id;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getPlace(): string
    {
        return $this->plate;
    }

    public function setPlate(string $plate): self
    {
        $this->plate = $plate;

        return $this;
    }

    public function getLicenseRequired(): string
    {
        return $this->licenseRequired;
    }

    public function setLicenseRequired(string $licenseRequired): self
    {
        $this->licenseRequired = $licenseRequired;

        return $this;
    }
}
