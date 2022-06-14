<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Classe::class, inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private $classe;

    #[ORM\ManyToOne(targetEntity: AnneeScolaire::class, inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private $anneescolaire;

    #[ORM\ManyToOne(targetEntity: Etudiant::class, inversedBy: 'inscriptions', cascade:["persist"])]
    #[ORM\JoinColumn(nullable: false)]
    private $etudiant;

    #[ORM\ManyToOne(targetEntity: AC::class, inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private $ac;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getAnneescolaire(): ?AnneeScolaire
    {
        return $this->anneescolaire;
    }

    public function setAnneescolaire(?AnneeScolaire $anneescolaire): self
    {
        $this->anneescolaire = $anneescolaire;

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

    public function getAc(): ?AC
    {
        return $this->ac;
    }

    public function setAc(?AC $ac): self
    {
        $this->ac = $ac;

        return $this;
    }
}
