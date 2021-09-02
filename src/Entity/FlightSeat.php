<?php

namespace App\Entity;

use App\Repository\FlightSeatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FlightSeatRepository::class)
 */
class FlightSeat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity=Flight::class, inversedBy="flightSeats")
     */
    private $flight;

    /**
     * @ORM\ManyToOne(targetEntity=Passenger::class, inversedBy="flightSeats")
     */
    private $passenger;

    /**
     * @ORM\ManyToOne(targetEntity=FlightSeatClasses::class, inversedBy="flightSeats")
     */
    private $flightSeatClass;

    /**
     * @ORM\ManyToOne(targetEntity=Airplane::class, inversedBy="flightSeats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $airplane;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getFlight(): ?Flight
    {
        return $this->flight;
    }

    public function setFlight(?Flight $flight): self
    {
        $this->flight = $flight;

        return $this;
    }

    public function getPassenger(): ?Passenger
    {
        return $this->passenger;
    }

    public function setPassenger(?Passenger $passenger): self
    {
        $this->passenger = $passenger;

        return $this;
    }

    public function getFlightSeatClass(): ?FlightSeatClasses
    {
        return $this->flightSeatClass;
    }

    public function setFlightSeatClass(?FlightSeatClasses $flightSeatClass): self
    {
        $this->flightSeatClass = $flightSeatClass;

        return $this;
    }

    public function getAirplane(): ?Airplane
    {
        return $this->airplane;
    }

    public function setAirplane(?Airplane $airplane): self
    {
        $this->airplane = $airplane;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
