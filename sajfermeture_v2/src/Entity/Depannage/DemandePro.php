<?php

namespace App\Entity\Depannage;

use App\Entity\Client\Pro\Professionnel;
use App\Entity\Demande\Image;
use App\Entity\General\DemandeStatut;
use App\Repository\Depannage\DemandeProRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeProRepository::class)]
class DemandePro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\OneToMany(mappedBy: 'demandePro', targetEntity: Image::class, orphanRemoval: true, cascade: ["persist", 'remove'])]
    private $images;

    #[ORM\ManyToOne(targetEntity: TypeDepannage::class, inversedBy: 'demandePros')]
    #[ORM\JoinColumn(nullable: false)]
    private $typeDepannage;

    #[ORM\ManyToOne(targetEntity: TypePorte::class, inversedBy: 'demandePros')]
    private $typePorte;

    #[ORM\OneToOne(inversedBy: 'demandePro', targetEntity: TypeMoteur::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private $typeMoteur;

    #[ORM\OneToOne(inversedBy: 'demandePro', targetEntity: InfoPorte::class, cascade: ['persist', 'remove'])]
    private $infoPorte;

    #[ORM\ManyToOne(targetEntity: Professionnel::class, inversedBy: 'demandePros')]
    #[ORM\JoinColumn(nullable: false)]
    private $professionnel;

    #[ORM\ManyToOne(targetEntity: DemandeStatut::class, inversedBy: 'demandePros')]
    #[ORM\JoinColumn(nullable: false)]
    private $demandeStatut;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setDemandePro($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getDemandePro() === $this) {
                $image->setDemandePro(null);
            }
        }

        return $this;
    }

    public function getTypeDepannage(): ?TypeDepannage
    {
        return $this->typeDepannage;
    }

    public function setTypeDepannage(?TypeDepannage $typeDepannage): self
    {
        $this->typeDepannage = $typeDepannage;

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

    public function getTypeMoteur(): ?TypeMoteur
    {
        return $this->typeMoteur;
    }

    public function setTypeMoteur(?TypeMoteur $typeMoteur): self
    {
        $this->typeMoteur = $typeMoteur;

        return $this;
    }

    public function getInfoPorte(): ?InfoPorte
    {
        return $this->infoPorte;
    }

    public function setInfoPorte(?InfoPorte $infoPorte): self
    {
        $this->infoPorte = $infoPorte;

        return $this;
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

    public function getDemandeStatut(): ?DemandeStatut
    {
        return $this->demandeStatut;
    }

    public function setDemandeStatut(?DemandeStatut $demandeStatut): self
    {
        $this->demandeStatut = $demandeStatut;

        return $this;
    }
}
