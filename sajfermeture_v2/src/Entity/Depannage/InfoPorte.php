<?php

namespace App\Entity\Depannage;

use App\Entity\Devis\DemandeDevis;
use App\Repository\Depannage\InfoPorteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InfoPorteRepository::class)]
class InfoPorte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float', nullable: true)]
    private $hauteur;

    #[ORM\Column(type: 'float', nullable: true)]
    private $largeur;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isEcoinCon;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isPassageLibre;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isRetombe;

    #[ORM\OneToOne(mappedBy: 'infoPorte', targetEntity: DemandePro::class, cascade: ['persist', 'remove'])]
    private $demandePro;

    #[ORM\OneToOne(mappedBy: 'infoPorte', targetEntity: DemandeDevis::class, cascade: ['persist', 'remove'])]
    private $demandeDevis;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHauteur(): ?float
    {
        return $this->hauteur;
    }

    public function setHauteur(?float $hauteur): self
    {
        $this->hauteur = $hauteur;

        return $this;
    }

    public function getLargeur(): ?float
    {
        return $this->largeur;
    }

    public function setLargeur(?float $largeur): self
    {
        $this->largeur = $largeur;

        return $this;
    }

    public function isIsEcoinCon(): ?bool
    {
        return $this->isEcoinCon;
    }

    public function setIsEcoinCon(?bool $isEcoinCon): self
    {
        $this->isEcoinCon = $isEcoinCon;

        return $this;
    }

    public function isIsPassageLibre(): ?bool
    {
        return $this->isPassageLibre;
    }

    public function setIsPassageLibre(?bool $isPassageLibre): self
    {
        $this->isPassageLibre = $isPassageLibre;

        return $this;
    }

    public function isIsRetombe(): ?bool
    {
        return $this->isRetombe;
    }

    public function setIsRetombe(?bool $isRetombe): self
    {
        $this->isRetombe = $isRetombe;

        return $this;
    }

    public function getDemandePro(): ?DemandePro
    {
        return $this->demandePro;
    }

    public function setDemandePro(?DemandePro $demandePro): self
    {
        // unset the owning side of the relation if necessary
        if ($demandePro === null && $this->demandePro !== null) {
            $this->demandePro->setInfoPorte(null);
        }

        // set the owning side of the relation if necessary
        if ($demandePro !== null && $demandePro->getInfoPorte() !== $this) {
            $demandePro->setInfoPorte($this);
        }

        $this->demandePro = $demandePro;

        return $this;
    }

    public function getDemandeDevis(): ?DemandeDevis
    {
        return $this->demandeDevis;
    }

    public function setDemandeDevis(DemandeDevis $demandeDevis): self
    {
        // set the owning side of the relation if necessary
        if ($demandeDevis->getInfoPorte() !== $this) {
            $demandeDevis->setInfoPorte($this);
        }

        $this->demandeDevis = $demandeDevis;

        return $this;
    }
}
