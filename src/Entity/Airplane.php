<?php

namespace App\Entity;

use App\Repository\AirplaneRepository;
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
}
