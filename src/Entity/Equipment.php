<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipmentRepository::class)
 */
class Equipment {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Task::class, inversedBy="equipment")
     * @ORM\JoinColumn(nullable=false)
     */
    private $task;

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    public function getQuantity(): ?string {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self {
        $this->quantity = $quantity;

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
        return $this->name;
    }

}
