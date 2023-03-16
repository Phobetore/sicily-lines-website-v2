<?php

namespace App\Entity;

use App\Repository\LiaisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LiaisonRepository::class)]
class Liaison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 6)]
    private ?string $duree = null;

    #[ORM\ManyToOne(inversedBy: 'liaisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?secteur $secteur = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?port $port_depart = null;

    #[ORM\ManyToOne(inversedBy: 'liaisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?port $port_arrivee = null;

    #[ORM\OneToMany(mappedBy: 'liaison', targetEntity: Traversee::class, orphanRemoval: true)]
    private Collection $traversees;

    public function __construct()
    {
        $this->traversees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getSecteur(): ?secteur
    {
        return $this->secteur;
    }

    public function setSecteur(?secteur $secteur): self
    {
        $this->secteur = $secteur;

        return $this;
    }

    public function getPortDepart(): ?port
    {
        return $this->port_depart;
    }

    public function setPortDepart(?port $port_depart): self
    {
        $this->port_depart = $port_depart;

        return $this;
    }

    public function getPortArrivee(): ?port
    {
        return $this->port_arrivee;
    }

    public function setPortArrivee(?port $port_arrivee): self
    {
        $this->port_arrivee = $port_arrivee;

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
            $traversee->setLiaison($this);
        }

        return $this;
    }

    public function removeTraversee(Traversee $traversee): self
    {
        if ($this->traversees->removeElement($traversee)) {
            // set the owning side to null (unless already changed)
            if ($traversee->getLiaison() === $this) {
                $traversee->setLiaison(null);
            }
        }

        return $this;
    }
}
