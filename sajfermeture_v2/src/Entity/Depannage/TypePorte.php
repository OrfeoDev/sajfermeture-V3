<?php

namespace App\Entity\Depannage;

use App\Entity\Devis\DemandeDevis;
use App\Repository\Depannage\TypePorteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypePorteRepository::class)]
class TypePorte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[ORM\OneToMany(mappedBy: 'typePorte', targetEntity: DemandePro::class)]
    private $demandePros;

    #[ORM\OneToMany(mappedBy: 'typePorte', targetEntity: DemandeDevis::class)]
    private $demandeDevis;

    public function __construct()
    {
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
            $demandePro->setTypePorte($this);
        }

        return $this;
    }

    public function removeDemandePro(DemandePro $demandePro): self
    {
        if ($this->demandePros->removeElement($demandePro)) {
            // set the owning side to null (unless already changed)
            if ($demandePro->getTypePorte() === $this) {
                $demandePro->setTypePorte(null);
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
            $demandeDevi->setTypePorte($this);
        }

        return $this;
    }

    public function removeDemandeDevi(DemandeDevis $demandeDevi): self
    {
        if ($this->demandeDevis->removeElement($demandeDevi)) {
            // set the owning side to null (unless already changed)
            if ($demandeDevi->getTypePorte() === $this) {
                $demandeDevi->setTypePorte(null);
            }
        }

        return $this;
    }
}
