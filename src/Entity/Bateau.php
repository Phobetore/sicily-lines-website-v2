<?php

namespace App\Entity;

use App\Repository\BateauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BateauRepository::class)]
class Bateau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $longueur = null;

    #[ORM\Column]
    private ?int $largeur = null;

    #[ORM\Column(length: 10)]
    private ?string $vitesse = null;

    #[ORM\OneToMany(mappedBy: 'bateau', targetEntity: EquipementBateau::class, orphanRemoval: true)]
    private Collection $equipementsBateau;

    #[ORM\OneToMany(mappedBy: 'bateau', targetEntity: BateauCategorie::class)]
    private Collection $bateauCategories;

    #[ORM\OneToMany(mappedBy: 'bateau', targetEntity: Traversee::class)]
    private Collection $traversees;

    public function __construct()
    {
        $this->equipementsBateau = new ArrayCollection();
        $this->bateauCategories = new ArrayCollection();
        $this->traversees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getLongueur(): ?int
    {
        return $this->longueur;
    }

    public function setLongueur(int $longueur): self
    {
        $this->longueur = $longueur;

        return $this;
    }

    public function getLargeur(): ?int
    {
        return $this->largeur;
    }

    public function setLargeur(int $largeur): self
    {
        $this->largeur = $largeur;

        return $this;
    }

    public function getVitesse(): ?string
    {
        return $this->vitesse;
    }

    public function setVitesse(string $vitesse): self
    {
        $this->vitesse = $vitesse;

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
            $equipementsBateau->setBateau($this);
        }

        return $this;
    }

    public function removeEquipementsBateau(EquipementBateau $equipementsBateau): self
    {
        if ($this->equipementsBateau->removeElement($equipementsBateau)) {
            // set the owning side to null (unless already changed)
            if ($equipementsBateau->getBateau() === $this) {
                $equipementsBateau->setBateau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BateauCategorie>
     */
    public function getBateauCategories(): Collection
    {
        return $this->bateauCategories;
    }

    public function addBateauCategory(BateauCategorie $bateauCategory): self
    {
        if (!$this->bateauCategories->contains($bateauCategory)) {
            $this->bateauCategories->add($bateauCategory);
            $bateauCategory->setBateau($this);
        }

        return $this;
    }

    public function removeBateauCategory(BateauCategorie $bateauCategory): self
    {
        if ($this->bateauCategories->removeElement($bateauCategory)) {
            // set the owning side to null (unless already changed)
            if ($bateauCategory->getBateau() === $this) {
                $bateauCategory->setBateau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Traversee>
     */
    public function getTraversees(): Collection
    {
        return $this->traversees;
    }

    public function addTraversee(Traversee $traversee): self
    {
        if (!$this->traversees->contains($traversee)) {
            $this->traversees->add($traversee);
            $traversee->setBateau($this);
        }

        return $this;
    }

    public function removeTraversee(Traversee $traversee): self
    {
        if ($this->traversees->removeElement($traversee)) {
            // set the owning side to null (unless already changed)
            if ($traversee->getBateau() === $this) {
                $traversee->setBateau(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return $this->nom;
    }

}
