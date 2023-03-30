<?php

namespace App\Entity;

use App\Repository\BateauCategorieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BateauCategorieRepository::class)]
class BateauCategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'bateauCategories')]
    private ?Bateau $bateau = null;

    #[ORM\ManyToOne(inversedBy: 'bateauCategories')]
    private ?Categorie $categorie = null;

    #[ORM\Column]
    private ?int $nbMax = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBateau(): ?bateau
    {
        return $this->bateau;
    }

    public function setBateau(?bateau $bateau): self
    {
        $this->bateau = $bateau;

        return $this;
    }

    public function getCategorie(): ?categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getNbMax(): ?int
    {
        return $this->nbMax;
    }

    public function setNbMax(int $nbMax): self
    {
        $this->nbMax = $nbMax;

        return $this;
    }
}
