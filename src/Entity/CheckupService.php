<?php

namespace App\Entity;

use App\Repository\CheckupServiceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CheckupServiceRepository::class)
 */
class CheckupService
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Service::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $service;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Checkup::class, inversedBy="checkupServices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $checkup;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getCheckup(): ?Checkup
    {
        return $this->checkup;
    }

    public function setCheckup(?Checkup $checkup): self
    {
        $this->checkup = $checkup;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
