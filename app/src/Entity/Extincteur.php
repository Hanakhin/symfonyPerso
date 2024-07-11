<?php

namespace App\Entity;

use App\Repository\ExtincteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExtincteurRepository::class)]
class Extincteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'extincteurs')]
    private ?ExtincteurType $extincteurTypeId = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFabrication = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateMaintenance = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    /**
     * @var Collection<int, Intervention>
     */
    #[ORM\ManyToMany(targetEntity: Intervention::class, inversedBy: 'extincteurs')]
    private Collection $interventionId;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'extincteurs')]
    private Collection $userId;

    #[ORM\Column(length: 255)]
    private ?string $quantity = null;

    public function __construct()
    {
        $this->interventionId = new ArrayCollection();
        $this->userId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExtincteurTypeId(): ?ExtincteurType
    {
        return $this->extincteurTypeId;
    }

    public function setExtincteurTypeId(?ExtincteurType $extincteurTypeId): static
    {
        $this->extincteurTypeId = $extincteurTypeId;

        return $this;
    }

    public function getDateFabrication(): ?\DateTimeInterface
    {
        return $this->dateFabrication;
    }

    public function setDateFabrication(\DateTimeInterface $dateFabrication): static
    {
        $this->dateFabrication = $dateFabrication;

        return $this;
    }

    public function getDateMaintenance(): ?\DateTimeInterface
    {
        return $this->dateMaintenance;
    }

    public function setDateMaintenance(\DateTimeInterface $dateMaintenance): static
    {
        $this->dateMaintenance = $dateMaintenance;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection<int, Intervention>
     */
    public function getInterventionId(): Collection
    {
        return $this->interventionId;
    }

    public function addInterventionId(Intervention $interventionId): static
    {
        if (!$this->interventionId->contains($interventionId)) {
            $this->interventionId->add($interventionId);
        }

        return $this;
    }

    public function removeInterventionId(Intervention $interventionId): static
    {
        $this->interventionId->removeElement($interventionId);

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

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }
}
