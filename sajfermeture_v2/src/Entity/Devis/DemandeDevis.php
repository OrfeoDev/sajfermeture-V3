<?php

namespace App\Entity\Devis;

use App\Entity\Client\Pro\Professionnel;
use App\Entity\Depannage\InfoPorte;
use App\Entity\Depannage\TypeMoteur;
use App\Entity\Depannage\TypePorte;
use App\Entity\General\DemandeStatut;
use App\Repository\Devis\DemandeDevisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeDevisRepository::class)]
class DemandeDevis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Professionnel::class, inversedBy: 'demandeDevis')]
    #[ORM\JoinColumn(nullable: false)]
    private $professionnel;

    #[ORM\OneToOne(inversedBy: 'demandeDevis', targetEntity: InfoPorte::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $infoPorte;

    #[ORM\ManyToOne(targetEntity: TypePorte::class, inversedBy: 'demandeDevis')]
    #[ORM\JoinColumn(nullable: false)]
    private $typePorte;

    #[ORM\ManyToOne(targetEntity: DemandeStatut::class, inversedBy: 'demandeDevis')]
    #[ORM\JoinColumn(nullable: false)]
    private $statut;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\OneToOne(inversedBy: 'demandeDevis', targetEntity: TypeMoteur::class, cascade: ['persist', 'remove'])]
    private $typeMoteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfessionnel(): ?Professionnel
    {
        return $this->professionnel;
    }

    public function setProfessionnel(?Professionnel $professionnel): self
    {
        $this->professionnel = $professionnel;

        return $this;
    }

    public function getInfoPorte(): ?InfoPorte
    {
        return $this->infoPorte;
    }

    public function setInfoPorte(InfoPorte $infoPorte): self
    {
        $this->infoPorte = $infoPorte;

        return $this;
    }

    public function getTypePorte(): ?TypePorte
    {
        return $this->typePorte;
    }

    public function setTypePorte(?TypePorte $typePorte): self
    {
        $this->typePorte = $typePorte;

        return $this;
    }

    public function getStatut(): ?DemandeStatut
    {
        return $this->statut;
    }

    public function setStatut(?DemandeStatut $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTypeMoteur(): ?TypeMoteur
    {
        return $this->typeMoteur;
    }

    public function setTypeMoteur(?TypeMoteur $typeMoteur): self
    {
        $this->typeMoteur = $typeMoteur;

        return $this;
    }
}
