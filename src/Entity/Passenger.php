<?php

namespace App\Entity;

use App\Repository\PassengerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PassengerRepository::class)
 */
class Passenger
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
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $middle_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gender;

    /**
     * @ORM\OneToMany(targetEntity=FlightSeat::class, mappedBy="passenger")
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

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middle_name;
    }

    public function setMiddleName(?string $middle_name): self
    {
        $this->middle_name = $middle_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

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
            $flightSeat->setPassenger($this);
        }

        return $this;
    }

    public function removeFlightSeat(FlightSeat $flightSeat): self
    {
        if ($this->flightSeats->removeElement($flightSeat)) {
            // set the owning side to null (unless already changed)
            if ($flightSeat->getPassenger() === $this) {
                $flightSeat->setPassenger(null);
            }
        }

        return $this;
    }

}
