<?php

namespace App\Entity;

use App\Repository\GalleryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GalleryRepository::class)]
class Gallery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Image>
     */
    #[ORM\ManyToMany(targetEntity: Image::class, inversedBy: 'galleries')]
    private Collection $images;

    #[ORM\OneToOne(mappedBy: 'gallery', cascade: ['persist', 'remove'])]
    private ?Trip $trip = null;

    #[ORM\OneToOne(mappedBy: 'gallery', cascade: ['persist', 'remove'])]
    private ?Poi $poi = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        $this->images->removeElement($image);

        return $this;
    }

    public function getTrip(): ?Trip
    {
        return $this->trip;
    }

    public function setTrip(Trip $trip): static
    {
        // set the owning side of the relation if necessary
        if ($trip->getGallery() !== $this) {
            $trip->setGallery($this);
        }

        $this->trip = $trip;

        return $this;
    }

    public function getPoi(): ?Poi
    {
        return $this->poi;
    }

    public function setPoi(?Poi $poi): static
    {
        // unset the owning side of the relation if necessary
        if ($poi === null && $this->poi !== null) {
            $this->poi->setGallery(null);
        }

        // set the owning side of the relation if necessary
        if ($poi !== null && $poi->getGallery() !== $this) {
            $poi->setGallery($this);
        }

        $this->poi = $poi;

        return $this;
    }
}
