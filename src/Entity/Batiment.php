<?php

namespace App\Entity;

use App\Repository\BatimentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BatimentRepository::class)]
class Batiment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $topologie = null;

    #[ORM\Column(length: 255)]
    private ?string $surface = null;

    #[ORM\ManyToOne(inversedBy: 'batiments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cite $cite = null;

    #[ORM\OneToMany(mappedBy: 'batiment', targetEntity: Bien::class, orphanRemoval: true)]
    private Collection $biens;

    public function __construct()
    {
        $this->biens = new ArrayCollection();
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

    public function getTopologie(): ?string
    {
        return $this->topologie;
    }

    public function setTopologie(string $topologie): self
    {
        $this->topologie = $topologie;

        return $this;
    }

    public function getSurface(): ?string
    {
        return $this->surface;
    }

    public function setSurface(string $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getCite(): ?Cite
    {
        return $this->cite;
    }

    public function setCite(?Cite $cite): self
    {
        $this->cite = $cite;

        return $this;
    }

    /**
     * @return Collection<int, Bien>
     */
    public function getBiens(): Collection
    {
        return $this->biens;
    }

    public function addBien(Bien $bien): self
    {
        if (!$this->biens->contains($bien)) {
            $this->biens->add($bien);
            $bien->setBatiment($this);
        }

        return $this;
    }

    public function removeBien(Bien $bien): self
    {
        if ($this->biens->removeElement($bien)) {
            // set the owning side to null (unless already changed)
            if ($bien->getBatiment() === $this) {
                $bien->setBatiment(null);
            }
        }

        return $this;
    }
    function __toString()
    {
        return $this->nom;
    }
}
