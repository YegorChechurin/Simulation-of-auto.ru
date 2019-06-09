<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdRepository")
 */
class Ad
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $owner_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $owner_city;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Car", inversedBy="ads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $car;

    public function getOwnerName(): ?string
    {
        return $this->owner_name;
    }

    public function setOwnerName(string $owner_name): self
    {
        $this->owner_name = $owner_name;

        return $this;
    }

    public function getOwnerCity(): ?string
    {
        return $this->owner_city;
    }

    public function setOwnerCity(string $owner_city): self
    {
        $this->owner_city = $owner_city;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): self
    {
        $this->car = $car;

        return $this;
    }
    
}
