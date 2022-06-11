<?php

namespace App\Entity\Demande;

use App\Entity\Client\Prospect\Prospect;
use App\Entity\General\DemandeStatut;
use App\Repository\Demande\DemandeProspectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeProspectRepository::class)]
class DemandeProspect
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

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\ManyToOne(targetEntity: Prospect::class, inversedBy: 'demandes')]
    #[ORM\JoinColumn(nullable: false)]
    private $prospect;

    #[ORM\ManyToOne(targetEntity: DemandeStatut::class, inversedBy: 'demandeProspects')]
    #[ORM\JoinColumn(nullable: false)]
    private $demandeStatut;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getProspect(): ?Prospect
    {
        return $this->prospect;
    }

    public function setProspect(?Prospect $prospect): self
    {
        $this->prospect = $prospect;

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
