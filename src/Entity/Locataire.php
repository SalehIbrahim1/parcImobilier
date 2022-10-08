<?php

namespace App\Entity;

use App\Repository\LocataireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocataireRepository::class)]
class Locataire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_de_naissance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lieu_de_naissance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_du_pere = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom_du_pere = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_de_la_mere = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom_de_la_mere = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $situation_familliale = null;

    #[ORM\Column(nullable: true)]
    private ?int $nombre_enfant = null;

    #[ORM\OneToMany(mappedBy: 'locataire', targetEntity: Contrat::class, orphanRemoval: true)]
    private Collection $contrats;

    public function __construct()
    {
        $this->contrats = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(?\DateTimeInterface $date_de_naissance): self
    {
        $this->date_de_naissance = $date_de_naissance;

        return $this;
    }

    public function getLieuDeNaissance(): ?string
    {
        return $this->lieu_de_naissance;
    }

    public function setLieuDeNaissance(?string $lieu_de_naissance): self
    {
        $this->lieu_de_naissance = $lieu_de_naissance;

        return $this;
    }

    public function getNomDuPere(): ?string
    {
        return $this->nom_du_pere;
    }

    public function setNomDuPere(?string $nom_du_pere): self
    {
        $this->nom_du_pere = $nom_du_pere;

        return $this;
    }

    public function getPrenomDuPere(): ?string
    {
        return $this->prenom_du_pere;
    }

    public function setPrenomDuPere(?string $prenom_du_pere): self
    {
        $this->prenom_du_pere = $prenom_du_pere;

        return $this;
    }

    public function getNomDeLaMere(): ?string
    {
        return $this->nom_de_la_mere;
    }

    public function setNomDeLaMere(?string $nom_de_la_mere): self
    {
        $this->nom_de_la_mere = $nom_de_la_mere;

        return $this;
    }

    public function getPrenomDeLaMere(): ?string
    {
        return $this->prenom_de_la_mere;
    }

    public function setPrenomDeLaMere(?string $prenom_de_la_mere): self
    {
        $this->prenom_de_la_mere = $prenom_de_la_mere;

        return $this;
    }

    public function getSituationFamilliale(): ?string
    {
        return $this->situation_familliale;
    }

    public function setSituationFamilliale(?string $situation_familliale): self
    {
        $this->situation_familliale = $situation_familliale;

        return $this;
    }

    public function getNombreEnfant(): ?int
    {
        return $this->nombre_enfant;
    }

    public function setNombreEnfant(?int $nombre_enfant): self
    {
        $this->nombre_enfant = $nombre_enfant;

        return $this;
    }

    /**
     * @return Collection<int, Contrat>
     */
    public function getContrats(): Collection
    {
        return $this->contrats;
    }

    public function addContrat(Contrat $contrat): self
    {
        if (!$this->contrats->contains($contrat)) {
            $this->contrats->add($contrat);
            $contrat->setLocataire($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrats->removeElement($contrat)) {
            // set the owning side to null (unless already changed)
            if ($contrat->getLocataire() === $this) {
                $contrat->setLocataire(null);
            }
        }

        return $this;
    }

    function __toString()
    {
        return $this->nom ." ". $this->prenom;
    }
}
