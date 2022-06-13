<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaymentRepository::class)
 */
class Payment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @ORM\Column(type="boolean")
     */
    private $type;

    /**
     * @ORM\OneToOne(targetEntity=Checkup::class, inversedBy="payment", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $checkup;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $registrar;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function isNonCash(): ?bool
    {
        return $this->type;
    }

    public function setType(bool $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCheckup(): ?Checkup
    {
        return $this->checkup;
    }

    public function setCheckup(Checkup $checkup): self
    {
        $this->checkup = $checkup;

        return $this;
    }

    public function getRegistrar(): ?User
    {
        return $this->registrar;
    }

    public function setRegistrar(?User $registrar): self
    {
        $this->registrar = $registrar;

        return $this;
    }
}
