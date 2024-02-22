<?php

namespace App\Entity;

use App\Entity\Vehicle;
use App\Entity\Driver;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TripRepository;

#[ORM\Entity(repositoryClass: TripRepository::class)]
#[ORM\Table(name: "trip")]
class Trip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Vehicle::class, inversedBy: "trips")]
    #[ORM\JoinColumn(nullable: false)]
    private Vehicle $vehicle;

    #[ORM\ManyToOne(targetEntity: Driver::class, inversedBy: "trips")]
    #[ORM\JoinColumn(nullable: false)]
    private Driver $driver;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(?Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    public function getDriver(): ?Driver
    {
        return $this->driver;
    }

    public function setDriver(?Driver $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
