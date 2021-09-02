<?php

namespace App\Entity;

use App\Repository\AirplaneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AirplaneRepository::class)
 */
class Airplane
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=AirlineCompany::class, inversedBy="airplanes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $airlineCompany;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\OneToMany(targetEntity=FlightSeat::class, mappedBy="airplane")
     */
    private $flightSeats;

    public function __construct()
    {
        $this->flightSeats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAirlineCompany(): ?AirlineCompany
    {
        return $this->airlineCompany;
    }

    public function setAirlineCompany(?AirlineCompany $airlineCompany): self
    {
        $this->airlineCompany = $airlineCompany;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return Collection|FlightSeat[]
     */
    public function getFlightSeats(): Collection
    {
        return $this->flightSeats;
    }

    public function addFlightSeat(FlightSeat $flightSeat): self
    {
        if (!$this->flightSeats->contains($flightSeat)) {
            $this->flightSeats[] = $flightSeat;
            $flightSeat->setAirplane($this);
        }

        return $this;
    }

    public function removeFlightSeat(FlightSeat $flightSeat): self
    {
        if ($this->flightSeats->removeElement($flightSeat)) {
            // set the owning side to null (unless already changed)
            if ($flightSeat->getAirplane() === $this) {
                $flightSeat->setAirplane(null);
            }
        }

        return $this;
    }
}
