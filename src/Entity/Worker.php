<?php

namespace App\Entity;

use App\Repository\WorkerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkerRepository::class)
 */
class Worker {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $specialty;

    /**
     * @ORM\ManyToOne(targetEntity=Task::class, inversedBy="workers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $task;

    public function getId(): ?int {
        return $this->id;
    }

    public function getFullName(): ?string {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self {
        $this->fullName = $fullName;

        return $this;
    }

    public function getSpecialty(): ?string {
        return $this->specialty;
    }

    public function setSpecialty(string $specialty): self {
        $this->specialty = $specialty;

        return $this;
    }

    public function getTask(): ?Task {
        return $this->task;
    }

    public function setTask(?Task $task): self {
        $this->task = $task;

        return $this;
    }

    public function __toString() {
        return $this->fullName;
    }

}
