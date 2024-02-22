<?php

namespace App\Entity;

use App\Entity\Trip;
use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
#[ORM\Table(name: "vehicles")]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["vehicle"])]
    private int $id;

    #[ORM\Column]
    #[Groups(["vehicle"])]
    private string $brand;

    #[ORM\Column]
    #[Groups(["vehicle"])]
    private string $model;

    #[ORM\Column]
    #[Groups(["vehicle"])]
    private string $plate;

    #[ORM\Column]
    #[Groups(["vehicle"])]
    private string $licenseRequired;

    #[ORM\OneToMany(targetEntity: Trip::class, mappedBy: "vehicle")]
    private $trips;

    public function __construct()
    {
        $this->trips = new ArrayCollection();
    }

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

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getPlate(): string
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

    /**
     * @return Collection|Trip[]
     */
    public function getTrips(): Collection
    {
        return $this->trips;
    }
}
