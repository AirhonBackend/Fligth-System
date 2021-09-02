<?php

namespace App\Entity;

use App\Repository\FlightRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FlightRepository::class)
 */
class Flight
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Destination::class, inversedBy="flights")
     * @ORM\JoinColumn(nullable=false)
     */
    private $destination;

    /**
     * @ORM\ManyToOne(targetEntity=Terminal::class, inversedBy="flights")
     */
    private $terminal;

    /**
     * @ORM\OneToMany(targetEntity=FlightSeat::class, mappedBy="flight")
     */
    private $flightSeats;

    /**
     * @ORM\Column(type="integer")
     */
    private $capacity;

    public function __construct()
    {
        $this->flightSeats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDestination(): ?Destination
    {
        return $this->destination;
    }

    public function setDestination(?Destination $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getTerminal(): ?Terminal
    {
        return $this->terminal;
    }

    public function setTerminal(?Terminal $terminal): self
    {
        $this->terminal = $terminal;

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
            $flightSeat->setFlight($this);
        }

        return $this;
    }

    public function removeFlightSeat(FlightSeat $flightSeat): self
    {
        if ($this->flightSeats->removeElement($flightSeat)) {
            // set the owning side to null (unless already changed)
            if ($flightSeat->getFlight() === $this) {
                $flightSeat->setFlight(null);
            }
        }

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;


        return $this;
    }

    public function decrementCapacity(): self
    {
        $this->capacity--;

        return $this;
    }
}
