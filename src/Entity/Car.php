<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
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
    private $producer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $body_style;

    /**
     * @ORM\Column(type="integer")
     */
    private $number_of_doors;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_speed;

    /**
     * @ORM\Column(type="float")
     */
    private $engine_volume;

    /**
     * @ORM\Column(type="float")
     */
    private $fuel_consumption;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $producer_country;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProducer(): ?string
    {
        return $this->producer;
    }

    public function setProducer(string $producer): self
    {
        $this->producer = $producer;

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

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getBodyStyle(): ?string
    {
        return $this->body_style;
    }

    public function setBodyStyle(string $body_style): self
    {
        $this->body_style = $body_style;

        return $this;
    }

    public function getNumberOfDoors(): ?int
    {
        return $this->number_of_doors;
    }

    public function setNumberOfDoors(int $number_of_doors): self
    {
        $this->number_of_doors = $number_of_doors;

        return $this;
    }

    public function getMaxSpeed(): ?int
    {
        return $this->max_speed;
    }

    public function setMaxSpeed(int $max_speed): self
    {
        $this->max_speed = $max_speed;

        return $this;
    }

    public function getEngineVolume(): ?float
    {
        return $this->engine_volume;
    }

    public function setEngineVolume(float $engine_volume): self
    {
        $this->engine_volume = $engine_volume;

        return $this;
    }

    public function getFuelConsumption(): ?float
    {
        return $this->fuel_consumption;
    }

    public function setFuelConsumption(float $fuel_consumption): self
    {
        $this->fuel_consumption = $fuel_consumption;

        return $this;
    }

    public function getProducerCountry(): ?string
    {
        return $this->producer_country;
    }

    public function setProducerCountry(string $producer_country): self
    {
        $this->producer_country = $producer_country;

        return $this;
    }
}
