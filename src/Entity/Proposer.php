<?php

namespace App\Entity;

use App\Repository\ProposerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProposerRepository::class)]
class Proposer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?equipement $equipement = null;

    #[ORM\ManyToOne(inversedBy: 'proposers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?bateau $bateau = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getEquipement(): ?equipement
    {
        return $this->equipement;
    }

    public function setEquipement(?equipement $equipement): self
    {
        $this->equipement = $equipement;

        return $this;
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
}
