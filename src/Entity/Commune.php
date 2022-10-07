<?php

namespace App\Entity;

use App\Repository\CommuneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommuneRepository::class)]
class Commune
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'communes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Daira $daira = null;

    #[ORM\OneToMany(mappedBy: 'commune', targetEntity: Cite::class, orphanRemoval: true)]
    private Collection $cites;

    public function __construct()
    {
        $this->cites = new ArrayCollection();
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

    public function getDaira(): ?Daira
    {
        return $this->daira;
    }

    public function setDaira(?Daira $daira): self
    {
        $this->daira = $daira;

        return $this;
    }

    /**
     * @return Collection<int, Cite>
     */
    public function getCites(): Collection
    {
        return $this->cites;
    }

    public function addCite(Cite $cite): self
    {
        if (!$this->cites->contains($cite)) {
            $this->cites->add($cite);
            $cite->setCommune($this);
        }

        return $this;
    }

    public function removeCite(Cite $cite): self
    {
        if ($this->cites->removeElement($cite)) {
            // set the owning side to null (unless already changed)
            if ($cite->getCommune() === $this) {
                $cite->setCommune(null);
            }
        }

        return $this;
    }

    function __toString()
    {
        return $this->nom;
    }
}
