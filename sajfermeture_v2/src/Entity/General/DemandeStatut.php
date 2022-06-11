<?php

namespace App\Entity\General;

use App\Entity\Demande\DemandeProspect;
use App\Entity\Depannage\DemandePro;
use App\Entity\Devis\DemandeDevis;
use App\Repository\General\DemandeStatutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeStatutRepository::class)]
class DemandeStatut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[ORM\Column(type: 'string', length: 255)]
    private $value;

    #[ORM\OneToMany(mappedBy: 'demandeStatut', targetEntity: DemandeProspect::class, orphanRemoval: true)]
    private $demandeProspects;

    #[ORM\OneToMany(mappedBy: 'demandeStatut', targetEntity: DemandePro::class, orphanRemoval: true)]
    private $demandePros;

    #[ORM\OneToMany(mappedBy: 'statut', targetEntity: DemandeDevis::class)]
    private $demandeDevis;

    public function __construct()
    {
        $this->demandeProspects = new ArrayCollection();
        $this->demandePros = new ArrayCollection();
        $this->demandeDevis = new ArrayCollection();
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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Collection<int, DemandeProspect>
     */
    public function getDemandeProspects(): Collection
    {
        return $this->demandeProspects;
    }

    public function addDemandeProspect(DemandeProspect $demandeProspect): self
    {
        if (!$this->demandeProspects->contains($demandeProspect)) {
            $this->demandeProspects[] = $demandeProspect;
            $demandeProspect->setDemandeStatut($this);
        }

        return $this;
    }

    public function removeDemandeProspect(DemandeProspect $demandeProspect): self
    {
        if ($this->demandeProspects->removeElement($demandeProspect)) {
            // set the owning side to null (unless already changed)
            if ($demandeProspect->getDemandeStatut() === $this) {
                $demandeProspect->setDemandeStatut(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DemandePro>
     */
    public function getDemandePros(): Collection
    {
        return $this->demandePros;
    }

    public function addDemandePro(DemandePro $demandePro): self
    {
        if (!$this->demandePros->contains($demandePro)) {
            $this->demandePros[] = $demandePro;
            $demandePro->setDemandeStatut($this);
        }

        return $this;
    }

    public function removeDemandePro(DemandePro $demandePro): self
    {
        if ($this->demandePros->removeElement($demandePro)) {
            // set the owning side to null (unless already changed)
            if ($demandePro->getDemandeStatut() === $this) {
                $demandePro->setDemandeStatut(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DemandeDevis>
     */
    public function getDemandeDevis(): Collection
    {
        return $this->demandeDevis;
    }

    public function addDemandeDevi(DemandeDevis $demandeDevi): self
    {
        if (!$this->demandeDevis->contains($demandeDevi)) {
            $this->demandeDevis[] = $demandeDevi;
            $demandeDevi->setStatut($this);
        }

        return $this;
    }

    public function removeDemandeDevi(DemandeDevis $demandeDevi): self
    {
        if ($this->demandeDevis->removeElement($demandeDevi)) {
            // set the owning side to null (unless already changed)
            if ($demandeDevi->getStatut() === $this) {
                $demandeDevi->setStatut(null);
            }
        }

        return $this;
    }
}
