<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AirlineCompanyRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AirlineCompanyRepository::class)
 */
class AirlineCompany
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $carrier_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $headquarters;

    /**
     * @ORM\OneToMany(targetEntity=Airplane::class, mappedBy="airlineCompany")
     */
    private $airplanes;

    public function __construct()
    {
        $this->airplanes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarrierName(): ?string
    {
        return $this->carrier_name;
    }

    public function setCarrierName(string $carrier_name): self
    {
        $this->carrier_name = $carrier_name;

        return $this;
    }

    public function getHeadquarters(): ?string
    {
        return $this->headquarters;
    }

    public function setHeadquarters(string $headquarters): self
    {
        $this->headquarters = $headquarters;

        return $this;
    }

    /**
     * @return Collection|Airplane[]
     */
    public function getAirplanes(): Collection
    {
        return $this->airplanes;
    }

    public function addAirplane(Airplane $airplane): self
    {
        if (!$this->airplanes->contains($airplane)) {
            $this->airplanes[] = $airplane;
            $airplane->setAirlineCompany($this);
        }

        return $this;
    }

    public function removeAirplane(Airplane $airplane): self
    {
        if ($this->airplanes->removeElement($airplane)) {
            // set the owning side to null (unless already changed)
            if ($airplane->getAirlineCompany() === $this) {
                $airplane->setAirlineCompany(null);
            }
        }

        return $this;
    }
}
