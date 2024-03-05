<?php

namespace App\Entity;

use App\Repository\AmenityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AmenityRepository::class)]
class Amenity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $am_dishwasher = null;

    #[ORM\Column]
    private ?bool $am_floor_coverings = null;

    #[ORM\Column]
    private ?bool $am_internet = null;

    #[ORM\Column]
    private ?bool $am_wardrobes = null;

    #[ORM\Column]
    private ?bool $am_supermarket = null;

    #[ORM\Column]
    private ?bool $am_kids_zone = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Property $am_prop = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isAmDishwasher(): ?bool
    {
        return $this->am_dishwasher;
    }

    public function setAmDishwasher(bool $am_dishwasher): static
    {
        $this->am_dishwasher = $am_dishwasher;

        return $this;
    }

    public function isAmFloorCoverings(): ?bool
    {
        return $this->am_floor_coverings;
    }

    public function setAmFloorCoverings(bool $am_floor_coverings): static
    {
        $this->am_floor_coverings = $am_floor_coverings;

        return $this;
    }

    public function isAmInternet(): ?bool
    {
        return $this->am_internet;
    }

    public function setAmInternet(bool $am_internet): static
    {
        $this->am_internet = $am_internet;

        return $this;
    }

    public function isAmWardrobes(): ?bool
    {
        return $this->am_wardrobes;
    }

    public function setAmWardrobes(bool $am_wardrobes): static
    {
        $this->am_wardrobes = $am_wardrobes;

        return $this;
    }

    public function isAmSupermarket(): ?bool
    {
        return $this->am_supermarket;
    }

    public function setAmSupermarket(bool $am_supermarket): static
    {
        $this->am_supermarket = $am_supermarket;

        return $this;
    }

    public function isAmKidsZone(): ?bool
    {
        return $this->am_kids_zone;
    }

    public function setAmKidsZone(bool $am_kids_zone): static
    {
        $this->am_kids_zone = $am_kids_zone;

        return $this;
    }

    public function getAmPropId(): ?Property
    {
        return $this->am_prop;
    }

    public function setAmPropId(Property $am_prop): static
    {
        $this->am_prop = $am_prop;

        return $this;
    }

}
