<?php

namespace App\Entity;

use App\Repository\ExtincteurTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExtincteurTypeRepository::class)]
class ExtincteurType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    /**
     * @var Collection<int, Extincteur>
     */
    #[ORM\OneToMany(targetEntity: Extincteur::class, mappedBy: 'extincteurTypeId')]
    private Collection $extincteurs;

    public function __construct()
    {
        $this->extincteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

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
            $extincteur->setExtincteurTypeId($this);
        }

        return $this;
    }

    public function removeExtincteur(Extincteur $extincteur): static
    {
        if ($this->extincteurs->removeElement($extincteur)) {
            // set the owning side to null (unless already changed)
            if ($extincteur->getExtincteurTypeId() === $this) {
                $extincteur->setExtincteurTypeId(null);
            }
        }

        return $this;
    }
}
