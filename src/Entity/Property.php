<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
class Property
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prop_housing_type = null;

    #[ORM\Column]
    private ?int $prop_nb_rooms = null;

    #[ORM\Column]
    private ?int $prop_sqm = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?int $prop_nb_beds = null;

    #[ORM\Column(nullable: true)]
    private ?int $prop_nb_baths = null;

    #[ORM\Column(nullable: true)]
    private ?int $prop_nb_spaces = null;

    #[ORM\Column(nullable: true)]
    private ?bool $prop_furnished = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPropHousingType(): ?string
    {
        return $this->prop_housing_type;
    }

    public function setPropHousingType(string $prop_housing_type): static
    {
        $this->prop_housing_type = $prop_housing_type;

        return $this;
    }

    public function getPropNbRooms(): ?int
    {
        return $this->prop_nb_rooms;
    }

    public function setPropNbRooms(int $prop_nb_rooms): static
    {
        $this->prop_nb_rooms = $prop_nb_rooms;

        return $this;
    }

    public function getPropSqm(): ?int
    {
        return $this->prop_sqm;
    }

    public function setPropSqm(int $prop_sqm): static
    {
        $this->prop_sqm = $prop_sqm;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getPropNbBeds(): ?int
    {
        return $this->prop_nb_beds;
    }

    public function setPropNbBeds(?int $prop_nb_beds): static
    {
        $this->prop_nb_beds = $prop_nb_beds;

        return $this;
    }

    public function getPropNbBaths(): ?int
    {
        return $this->prop_nb_baths;
    }

    public function setPropNbBaths(?int $prop_nb_baths): static
    {
        $this->prop_nb_baths = $prop_nb_baths;

        return $this;
    }

    public function getPropNbSpaces(): ?int
    {
        return $this->prop_nb_spaces;
    }

    public function setPropNbSpaces(?int $prop_nb_spaces): static
    {
        $this->prop_nb_spaces = $prop_nb_spaces;

        return $this;
    }

    public function isPropFurnished(): ?bool
    {
        return $this->prop_furnished;
    }

    public function setPropFurnished(?bool $prop_furnished): static
    {
        $this->prop_furnished = $prop_furnished;

        return $this;
    }

}
