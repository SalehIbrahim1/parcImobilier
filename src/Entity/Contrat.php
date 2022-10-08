<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContratRepository::class)]
class Contrat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column]
    private ?float $loyer_principale = null;

    #[ORM\Column]
    private ?float $cautionnement = null;

    #[ORM\Column]
    private ?float $charge = null;

    #[ORM\Column]
    private ?float $frais_timbre = null;

    #[ORM\Column]
    private ?float $frais_enregistrement = null;

    #[ORM\Column]
    private ?float $tva = null;

    #[ORM\ManyToOne(inversedBy: 'contrats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Locataire $locataire = null;

    #[ORM\OneToMany(mappedBy: 'contrat', targetEntity: Payement::class, orphanRemoval: true)]
    private Collection $payements;

    public function __construct()
    {
        $this->payements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getLoyerPrincipale(): ?float
    {
        return $this->loyer_principale;
    }

    public function setLoyerPrincipale(float $loyer_principale): self
    {
        $this->loyer_principale = $loyer_principale;

        return $this;
    }

    public function getCautionnement(): ?float
    {
        return $this->cautionnement;
    }

    public function setCautionnement(float $cautionnement): self
    {
        $this->cautionnement = $cautionnement;

        return $this;
    }

    public function getCharge(): ?float
    {
        return $this->charge;
    }

    public function setCharge(float $charge): self
    {
        $this->charge = $charge;

        return $this;
    }

    public function getFraisTimbre(): ?float
    {
        return $this->frais_timbre;
    }

    public function setFraisTimbre(float $frais_timbre): self
    {
        $this->frais_timbre = $frais_timbre;

        return $this;
    }

    public function getFraisEnregistrement(): ?float
    {
        return $this->frais_enregistrement;
    }

    public function setFraisEnregistrement(float $frais_enregistrement): self
    {
        $this->frais_enregistrement = $frais_enregistrement;

        return $this;
    }

    public function getTva(): ?float
    {
        return $this->tva;
    }

    public function setTva(float $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getLocataire(): ?Locataire
    {
        return $this->locataire;
    }

    public function setLocataire(?Locataire $locataire): self
    {
        $this->locataire = $locataire;

        return $this;
    }

    /**
     * @return Collection<int, Payement>
     */
    public function getPayements(): Collection
    {
        return $this->payements;
    }

    public function addPayement(Payement $payement): self
    {
        if (!$this->payements->contains($payement)) {
            $this->payements->add($payement);
            $payement->setContrat($this);
        }

        return $this;
    }

    public function removePayement(Payement $payement): self
    {
        if ($this->payements->removeElement($payement)) {
            // set the owning side to null (unless already changed)
            if ($payement->getContrat() === $this) {
                $payement->setContrat(null);
            }
        }

        return $this;
    }
}
