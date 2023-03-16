<?php

namespace App\Entity;

use App\Repository\TraverseeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraverseeRepository::class)]
class Traversee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure = null;

    #[ORM\ManyToOne(inversedBy: 'traversees')]
    private ?bateau $bateau = null;

    #[ORM\ManyToOne(inversedBy: 'traversees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?liaison $liaison = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

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

    public function getLiaison(): ?liaison
    {
        return $this->liaison;
    }

    public function setLiaison(?liaison $liaison): self
    {
        $this->liaison = $liaison;

        return $this;
    }
}
