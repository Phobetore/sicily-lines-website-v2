<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: BateauCategorie::class)]
    private Collection $bateauCategories;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Type::class)]
    private Collection $types;

    public function __construct()
    {
        $this->bateauCategories = new ArrayCollection();
        $this->types = new ArrayCollection();
    }

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: BateauCategorie::class)]

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
            $bateauCategory->setCategorie($this);
        }

        return $this;
    }

    public function removeBateauCategory(BateauCategorie $bateauCategory): self
    {
        if ($this->bateauCategories->removeElement($bateauCategory)) {
            // set the owning side to null (unless already changed)
            if ($bateauCategory->getCategorie() === $this) {
                $bateauCategory->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
            $type->setCategorie($this);
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        if ($this->types->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getCategorie() === $this) {
                $type->setCategorie(null);
            }
        }

        return $this;
    }


    public function __toString(){
        return $this->libelle;
    }
}
