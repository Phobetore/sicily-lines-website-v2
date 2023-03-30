<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'types')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: LiaisonPeriodeType::class)]
    private Collection $liaisonPeriodeTypes;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: ReservationType::class)]
    private Collection $reservationTypes;

    public function __construct()
    {
        $this->liaisonPeriodeTypes = new ArrayCollection();
        $this->reservationTypes = new ArrayCollection();
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

    public function getCategorie(): ?categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, LiaisonPeriodeType>
     */
    public function getLiaisonPeriodeTypes(): Collection
    {
        return $this->liaisonPeriodeTypes;
    }

    public function addLiaisonPeriodeType(LiaisonPeriodeType $liaisonPeriodeType): self
    {
        if (!$this->liaisonPeriodeTypes->contains($liaisonPeriodeType)) {
            $this->liaisonPeriodeTypes->add($liaisonPeriodeType);
            $liaisonPeriodeType->setType($this);
        }

        return $this;
    }

    public function removeLiaisonPeriodeType(LiaisonPeriodeType $liaisonPeriodeType): self
    {
        if ($this->liaisonPeriodeTypes->removeElement($liaisonPeriodeType)) {
            // set the owning side to null (unless already changed)
            if ($liaisonPeriodeType->getType() === $this) {
                $liaisonPeriodeType->setType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ReservationType>
     */
    public function getReservationTypes(): Collection
    {
        return $this->reservationTypes;
    }

    public function addReservationType(ReservationType $reservationType): self
    {
        if (!$this->reservationTypes->contains($reservationType)) {
            $this->reservationTypes->add($reservationType);
            $reservationType->setType($this);
        }

        return $this;
    }

    public function removeReservationType(ReservationType $reservationType): self
    {
        if ($this->reservationTypes->removeElement($reservationType)) {
            // set the owning side to null (unless already changed)
            if ($reservationType->getType() === $this) {
                $reservationType->setType(null);
            }
        }

        return $this;
    }
}
