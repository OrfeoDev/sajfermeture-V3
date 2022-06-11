<?php

namespace App\Entity\Demande;

use App\Entity\Depannage\DemandePro;
use App\Repository\Demande\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $fileName;

    #[ORM\ManyToOne(targetEntity: DemandePro::class, inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false)]
    private $demandePro;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getDemandePro(): ?DemandePro
    {
        return $this->demandePro;
    }

    public function setDemandePro(?DemandePro $demandePro): self
    {
        $this->demandePro = $demandePro;

        return $this;
    }
}
