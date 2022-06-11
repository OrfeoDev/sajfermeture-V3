<?php

namespace App\Entity\Client\Pro;

use App\Entity\Authentication\User;
use App\Entity\Depannage\DemandePro;
use App\Entity\Devis\DemandeDevis;
use App\Repository\Client\Pro\ProfessionnelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfessionnelRepository::class)]
class Professionnel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastName;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $phone;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\Column(type: 'string', length: 255)]
    private $postalCode;

    #[ORM\Column(type: 'string', length: 255)]
    private $address;

    #[ORM\Column(type: 'string', length: 255)]
    private $country;

    #[ORM\Column(type: 'string', length: 255)]
    private $socialReason;

    #[ORM\Column(type: 'string', length: 255)]
    private $siret;

    #[ORM\OneToMany(mappedBy: 'professionnel', targetEntity: DemandePro::class, orphanRemoval: true)]
    private $demandePros;

    #[ORM\OneToOne(mappedBy: 'professionnel', targetEntity: User::class, cascade: ['persist', 'remove'])]
    private $user;

    #[ORM\OneToMany(mappedBy: 'professionnel', targetEntity: DemandeDevis::class, orphanRemoval: true)]
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

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getSocialReason(): ?string
    {
        return $this->socialReason;
    }

    public function setSocialReason(string $socialReason): self
    {
        $this->socialReason = $socialReason;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

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
            $demandePro->setProfessionnel($this);
        }

        return $this;
    }

    public function removeDemandePro(DemandePro $demandePro): self
    {
        if ($this->demandePros->removeElement($demandePro)) {
            // set the owning side to null (unless already changed)
            if ($demandePro->getProfessionnel() === $this) {
                $demandePro->setProfessionnel(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setProfessionnel(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getProfessionnel() !== $this) {
            $user->setProfessionnel($this);
        }

        $this->user = $user;

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
            $demandeDevi->setProfessionnel($this);
        }

        return $this;
    }

    public function removeDemandeDevi(DemandeDevis $demandeDevi): self
    {
        if ($this->demandeDevis->removeElement($demandeDevi)) {
            // set the owning side to null (unless already changed)
            if ($demandeDevi->getProfessionnel() === $this) {
                $demandeDevi->setProfessionnel(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->lastName . ' ' . $this->firstName;
    }
}
