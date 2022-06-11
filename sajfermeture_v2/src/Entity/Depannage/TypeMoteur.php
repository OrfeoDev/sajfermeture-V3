<?php

namespace App\Entity\Depannage;

use App\Entity\Devis\DemandeDevis;
use App\Repository\Depannage\TypeMoteurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeMoteurRepository::class)]
class TypeMoteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $numeroMoteur;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $voltage;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $typeFonctionnement;

    #[ORM\OneToOne(mappedBy: 'typeMoteur', targetEntity: DemandePro::class, cascade: ['persist', 'remove'])]
    private $demandePro;

    #[ORM\OneToOne(mappedBy: 'typeMoteur', targetEntity: DemandeDevis::class, cascade: ['persist', 'remove'])]
    private $demandeDevis;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroMoteur(): ?string
    {
        return $this->numeroMoteur;
    }

    public function setNumeroMoteur(?string $numeroMoteur): self
    {
        $this->numeroMoteur = $numeroMoteur;

        return $this;
    }

    public function getVoltage(): ?string
    {
        return $this->voltage;
    }

    public function setVoltage(string $voltage): self
    {
        $this->voltage = $voltage;

        return $this;
    }

    public function getTypeFonctionnement(): ?string
    {
        return $this->typeFonctionnement;
    }

    public function setTypeFonctionnement(?string $typeFonctionnement): self
    {
        $this->typeFonctionnement = $typeFonctionnement;

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
            $this->demandePro->setTypeMoteur(null);
        }

        // set the owning side of the relation if necessary
        if ($demandePro !== null && $demandePro->getTypeMoteur() !== $this) {
            $demandePro->setTypeMoteur($this);
        }

        $this->demandePro = $demandePro;

        return $this;
    }

    public function getDemandeDevis(): ?DemandeDevis
    {
        return $this->demandeDevis;
    }

    public function setDemandeDevis(?DemandeDevis $demandeDevis): self
    {
        // unset the owning side of the relation if necessary
        if ($demandeDevis === null && $this->demandeDevis !== null) {
            $this->demandeDevis->setTypeMoteur(null);
        }

        // set the owning side of the relation if necessary
        if ($demandeDevis !== null && $demandeDevis->getTypeMoteur() !== $this) {
            $demandeDevis->setTypeMoteur($this);
        }

        $this->demandeDevis = $demandeDevis;

        return $this;
    }
}
