<?php

namespace App\Entity;

use App\Repository\TimetableRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TimetableRepository::class)
 */
class Timetable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $day;

    /**
     * @ORM\Column(type="time")
     */
    private $workStart;

    /**
     * @ORM\Column(type="time")
     */
    private $workEnd;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $doctor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(int $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getWorkStart(): ?\DateTimeInterface
    {
        return $this->workStart;
    }

    public function setWorkStart(\DateTimeInterface $workStart): self
    {
        $this->workStart = $workStart;

        return $this;
    }

    public function getWorkEnd(): ?\DateTimeInterface
    {
        return $this->workEnd;
    }

    public function setWorkEnd(\DateTimeInterface $workEnd): self
    {
        $this->workEnd = $workEnd;

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
}
