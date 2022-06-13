<?php

namespace App\Entity;

use App\Repository\CheckupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CheckupRepository::class)
 */
class Checkup
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
    private $startDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $complaints;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $diagnosis;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $treatment;

    /**
     * @ORM\Column(type="smallint")
     */
    private $type;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $doctor;

    /**
     * @ORM\ManyToOne(targetEntity=Animal::class, inversedBy="checkups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $animal;

    /**
     * @ORM\OneToOne(targetEntity=Payment::class, mappedBy="checkup", cascade={"persist", "remove"})
     */
    private $payment;

    /**
     * @ORM\OneToMany(targetEntity=CheckupService::class, mappedBy="checkup")
     */
    private $checkupServices;

    public function __construct()
    {
        $this->checkupServices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getComplaints(): ?string
    {
        return $this->complaints;
    }

    public function setComplaints(string $complaints): self
    {
        $this->complaints = $complaints;

        return $this;
    }

    public function getDiagnosis(): ?string
    {
        return $this->diagnosis;
    }

    public function setDiagnosis(string $diagnosis): self
    {
        $this->diagnosis = $diagnosis;

        return $this;
    }

    public function getTreatment(): ?string
    {
        return $this->treatment;
    }

    public function setTreatment(string $treatment): self
    {
        $this->treatment = $treatment;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

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

    public function getDoctor(): ?User
    {
        return $this->doctor;
    }

    public function setDoctor(?User $doctor): self
    {
        $this->doctor = $doctor;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): self
    {
        $this->animal = $animal;

        return $this;
    }

    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    public function setPayment(Payment $payment): self
    {
        // set the owning side of the relation if necessary
        if ($payment->getCheckup() !== $this) {
            $payment->setCheckup($this);
        }

        $this->payment = $payment;

        return $this;
    }

    /**
     * @return Collection<int, CheckupService>
     */
    public function getCheckupServices(): Collection
    {
        return $this->checkupServices;
    }

    public function addCheckupService(CheckupService $checkupService): self
    {
        if (!$this->checkupServices->contains($checkupService)) {
            $this->checkupServices[] = $checkupService;
            $checkupService->setCheckup($this);
        }

        return $this;
    }

    public function removeCheckupService(CheckupService $checkupService): self
    {
        if ($this->checkupServices->removeElement($checkupService)) {
            // set the owning side to null (unless already changed)
            if ($checkupService->getCheckup() === $this) {
                $checkupService->setCheckup(null);
            }
        }

        return $this;
    }
}
