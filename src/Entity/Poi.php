<?php

namespace App\Entity;

use App\Repository\PoiRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PoiRepository::class)]
class Poi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $point = null;

    #[ORM\ManyToOne(inversedBy: 'pois')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Localisation $localisation = null;

    #[ORM\OneToOne(inversedBy: 'poi', cascade: ['persist', 'remove'])]
    private ?Gallery $gallery = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoint(): ?string
    {
        return $this->point;
    }

    public function setPoint(string $point): static
    {
        $this->point = $point;

        return $this;
    }

    public function getLocalisation(): ?Localisation
    {
        return $this->localisation;
    }

    public function setLocalisation(?Localisation $localisation): static
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getGallery(): ?Gallery
    {
        return $this->gallery;
    }

    public function setGallery(?Gallery $gallery): static
    {
        $this->gallery = $gallery;

        return $this;
    }
}
