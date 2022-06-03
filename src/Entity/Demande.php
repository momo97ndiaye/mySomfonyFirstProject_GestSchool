<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DemandeRepository;

#[ORM\Entity(repositoryClass: DemandeRepository::class)]
class Demande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 50)]
    protected $libelleDemande;

    #[ORM\ManyToOne(targetEntity: Etudiant::class, inversedBy: 'demandes')]
    #[ORM\JoinColumn(nullable: false)]
    protected $etudiant;

    #[ORM\ManyToOne(targetEntity: RP::class, inversedBy: 'demandes')]
    #[ORM\JoinColumn(nullable: false)]
    protected $rP;

    #[ORM\Column(type: 'date')]
    protected $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleDemande(): ?string
    {
        return $this->libelleDemande;
    }

    public function setLibelleDemande(string $libelleDemande): self
    {
        $this->libelleDemande = $libelleDemande;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getRP(): ?RP
    {
        return $this->rP;
    }

    public function setRP(?RP $rP): self
    {
        $this->rP = $rP;

        return $this;
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
}
