<?php

namespace App\Entity\Setting;

use App\Repository\Setting\AppInformationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppInformationRepository::class)]
class AppInformation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tokenCreateComptePro;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTokenCreateComptePro(): ?string
    {
        return $this->tokenCreateComptePro;
    }

    public function setTokenCreateComptePro(?string $tokenCreateComptePro): self
    {
        $this->tokenCreateComptePro = $tokenCreateComptePro;

        return $this;
    }
}
