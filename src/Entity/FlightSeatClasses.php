<?php

namespace App\Entity;

use App\Repository\FlightSeatClassesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FlightSeatClassesRepository::class)
 */
class FlightSeatClasses
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=FlightSeat::class, mappedBy="flightSeatClass")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $flightSeat->setFlightSeatClass($this);
        }

        return $this;
    }

    public function removeFlightSeat(FlightSeat $flightSeat): self
    {
        if ($this->flightSeats->removeElement($flightSeat)) {
            // set the owning side to null (unless already changed)
            if ($flightSeat->getFlightSeatClass() === $this) {
                $flightSeat->setFlightSeatClass(null);
            }
        }

        return $this;
    }

}
