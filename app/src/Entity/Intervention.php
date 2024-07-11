<?php

namespace App\Entity;

use App\Repository\InterventionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterventionRepository::class)]
class Intervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Status $statusId = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'interventions')]
    private Collection $userId;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateIntervention = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Rapport $rapportId = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    private ?TypeIntervention $typeInterventionId = null;

    #[ORM\Column]
    public ?bool $isUrgent ;

    /**
     * @var Collection<int, Extincteur>
     */
    #[ORM\ManyToMany(targetEntity: Extincteur::class, mappedBy: 'interventionId')]
    private Collection $extincteurs;

    public function __construct()
    {
        $this->userId = new ArrayCollection();
        $this->extincteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getStatusId(): ?Status
    {
        return $this->statusId;
    }

    public function setStatusId(?Status $statusId): static
    {
        $this->statusId = $statusId;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserId(): Collection
    {
        return $this->userId;
    }

    public function addUserId(User $userId): static
    {
        if (!$this->userId->contains($userId)) {
            $this->userId->add($userId);
        }

        return $this;
    }

    public function removeUserId(User $userId): static
    {
        $this->userId->removeElement($userId);

        return $this;
    }

    public function getDateIntervention(): ?\DateTimeInterface
    {
        return $this->dateIntervention;
    }

    public function setDateIntervention(\DateTimeInterface $dateIntervention): static
    {
        $this->dateIntervention = $dateIntervention;

        return $this;
    }

    public function getRapportId(): ?Rapport
    {
        return $this->rapportId;
    }

    public function setRapportId(?Rapport $rapportId): static
    {
        $this->rapportId = $rapportId;

        return $this;
    }

    public function getTypeInterventionId(): ?TypeIntervention
    {
        return $this->typeInterventionId;
    }

    public function setTypeInterventionId(?TypeIntervention $typeInterventionId): static
    {
        $this->typeInterventionId = $typeInterventionId;

        return $this;
    }

    public function isUrgent(): ?bool
    {
        return $this->isUrgent;
    }

    public function setUrgent(bool $isUrgent): static
    {
        $this->isUrgent = $isUrgent;

        return $this;
    }

    /**
     * @return Collection<int, Extincteur>
     */
    public function getExtincteurs(): Collection
    {
        return $this->extincteurs;
    }

    public function addExtincteur(Extincteur $extincteur): static
    {
        if (!$this->extincteurs->contains($extincteur)) {
            $this->extincteurs->add($extincteur);
            $extincteur->addInterventionId($this);
        }

        return $this;
    }

    public function removeExtincteur(Extincteur $extincteur): static
    {
        if ($this->extincteurs->removeElement($extincteur)) {
            $extincteur->removeInterventionId($this);
        }

        return $this;
    }
}
