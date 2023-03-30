<?php

namespace App\Entity;

use App\Repository\EquipementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipementRepository::class)]
class Equipement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'equipement', targetEntity: EquipementBateau::class, orphanRemoval: true)]
    private Collection $equipementsBateau;

    public function __construct()
    {
        $this->equipementsBateau = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, EquipementBateau>
     */
    public function getEquipementsBateau(): Collection
    {
        return $this->equipementsBateau;
    }

    public function addEquipementsBateau(EquipementBateau $equipementsBateau): self
    {
        if (!$this->equipementsBateau->contains($equipementsBateau)) {
            $this->equipementsBateau->add($equipementsBateau);
            $equipementsBateau->setEquipement($this);
        }

        return $this;
    }

    public function removeEquipementsBateau(EquipementBateau $equipementsBateau): self
    {
        if ($this->equipementsBateau->removeElement($equipementsBateau)) {
            // set the owning side to null (unless already changed)
            if ($equipementsBateau->getEquipement() === $this) {
                $equipementsBateau->setEquipement(null);
            }
        }

        return $this;
    }
}
