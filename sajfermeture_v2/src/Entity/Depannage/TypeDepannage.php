<?php

namespace App\Entity\Depannage;

use App\Repository\Depannage\TypeDepannageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeDepannageRepository::class)]
class TypeDepannage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[ORM\OneToMany(mappedBy: 'typeDepannage', targetEntity: DemandePro::class)]
    private $demandePros;

    #[ORM\Column(type: 'string', length: 255)]
    private $value;

    public function __construct()
    {
        $this->demandePros = new ArrayCollection();
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
            $demandePro->setTypeDepannage($this);
        }

        return $this;
    }

    public function removeDemandePro(DemandePro $demandePro): self
    {
        if ($this->demandePros->removeElement($demandePro)) {
            // set the owning side to null (unless already changed)
            if ($demandePro->getTypeDepannage() === $this) {
                $demandePro->setTypeDepannage(null);
            }
        }

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
}
