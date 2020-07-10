<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task {

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
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    /**
     * @ORM\OneToMany(targetEntity=Equipment::class, mappedBy="task", orphanRemoval=true)
     */
    private $equipment;

    /**
     * @ORM\OneToMany(targetEntity=Worker::class, mappedBy="task", orphanRemoval=true)
     */
    private $workers;

    public function __construct() {
        $this->equipment = new ArrayCollection();
        $this->workers = new ArrayCollection();
    }

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

    public function getStartDate(): ?\DateTimeInterface {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self {
        $this->endDate = $endDate;

        return $this;
    }

    public function getProject(): ?Project {
        return $this->project;
    }

    public function setProject(?Project $project): self {
        $this->project = $project;

        return $this;
    }

    /**
     * @return Collection|Equipment[]
     */
    public function getEquipment(): Collection {
        return $this->equipment;
    }

    public function addEquipment(Equipment $equipment): self {
        if (!$this->equipment->contains($equipment)) {
            $this->equipment[] = $equipment;
            $equipment->setTask($this);
        }

        return $this;
    }

    public function removeEquipment(Equipment $equipment): self {
        if ($this->equipment->contains($equipment)) {
            $this->equipment->removeElement($equipment);
            // set the owning side to null (unless already changed)
            if ($equipment->getTask() === $this) {
                $equipment->setTask(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Worker[]
     */
    public function getWorkers(): Collection {
        return $this->workers;
    }

    public function addWorker(Worker $worker): self {
        if (!$this->workers->contains($worker)) {
            $this->workers[] = $worker;
            $worker->setTask($this);
        }

        return $this;
    }

    public function removeWorker(Worker $worker): self {
        if ($this->workers->contains($worker)) {
            $this->workers->removeElement($worker);
            // set the owning side to null (unless already changed)
            if ($worker->getTask() === $this) {
                $worker->setTask(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->name;
    }

}
