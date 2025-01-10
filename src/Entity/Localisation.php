<?php

namespace App\Entity;

use App\Repository\LocalisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocalisationRepository::class)]
class Localisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $start = null;

    #[ORM\Column(length: 255)]
    private ?string $finish = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 3)]
    private ?string $distance = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $duration = null;

    #[ORM\OneToOne(mappedBy: 'localisation', cascade: ['persist', 'remove'])]
    private ?Trip $trip = null;

    /**
     * @var Collection<int, Poi>
     */
    #[ORM\OneToMany(targetEntity: Poi::class, mappedBy: 'localisation', orphanRemoval: true)]
    private Collection $pois;

    public function __construct()
    {
        $this->pois = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?string
    {
        return $this->start;
    }

    public function setStart(string $start): static
    {
        $this->start = $start;

        return $this;
    }

    public function getFinish(): ?string
    {
        return $this->finish;
    }

    public function setFinish(string $finish): static
    {
        $this->finish = $finish;

        return $this;
    }

    public function getDistance(): ?string
    {
        return $this->distance;
    }

    public function setDistance(string $distance): static
    {
        $this->distance = $distance;

        return $this;
    }

    public function getDuration(): ?\DateTimeInterface
    {
        return $this->duration;
    }

    public function setDuration(\DateTimeInterface $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getTrip(): ?Trip
    {
        return $this->trip;
    }

    public function setTrip(Trip $trip): static
    {
        // set the owning side of the relation if necessary
        if ($trip->getLocalisation() !== $this) {
            $trip->setLocalisation($this);
        }

        $this->trip = $trip;

        return $this;
    }

    /**
     * @return Collection<int, Poi>
     */
    public function getPois(): Collection
    {
        return $this->pois;
    }

    public function addPoi(Poi $poi): static
    {
        if (!$this->pois->contains($poi)) {
            $this->pois->add($poi);
            $poi->setLocalisation($this);
        }

        return $this;
    }

    public function removePoi(Poi $poi): static
    {
        if ($this->pois->removeElement($poi)) {
            // set the owning side to null (unless already changed)
            if ($poi->getLocalisation() === $this) {
                $poi->setLocalisation(null);
            }
        }

        return $this;
    }
}
