<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\TimestampTraits;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
#[ORM\HasLifecycleCallbacks]

class Property
{
    use TimestampTraits;

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

    #[ORM\Column(nullable: true)]
    private ?int $prop_nb_beds = null;

    #[ORM\Column(nullable: true)]
    private ?int $prop_nb_baths = null;

    #[ORM\Column(nullable: true)]
    private ?int $prop_nb_spaces = null;

    #[ORM\Column(nullable: true)]
    private ?bool $prop_furnished = null;

    #[ORM\Column]
    private ?int $prop_price = null;

    #[ORM\OneToMany(targetEntity: Picture::class, mappedBy: 'property', cascade:['persist','remove'])]
    private Collection $Picture;

    #[ORM\ManyToOne(inversedBy: 'properties')]
    private ?Category $Category = null;

    #[ORM\Column(length: 255)]
    private ?string $propTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $propDescription = null;

    #[ORM\ManyToOne(inversedBy: 'properties')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $AgentImmobilier = null;

    #[ORM\OneToMany(targetEntity: Amenity::class, mappedBy: 'property')]
    private Collection $amenities;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $propLongitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $propLatitude = null;

    public function __construct()
    {
        $this->Picture = new ArrayCollection();
        $this->amenities = new ArrayCollection();
    }

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

    public function getPropPrice(): ?int
    {
        return $this->prop_price;
    }

    public function setPropPrice(int $prop_price): static
    {
        $this->prop_price = $prop_price;

        return $this;
    }

    /**
     * @return Collection<int, Picture>
     */
    public function getPicture(): Collection
    {
        return $this->Picture;
    }

    public function addPicture(Picture $picture): static
    {
        if (!$this->Picture->contains($picture)) {
            $this->Picture->add($picture);
            $picture->setProperty($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): static
    {
        if ($this->Picture->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getProperty() === $this) {
                $picture->setProperty(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): static
    {
        $this->Category = $Category;

        return $this;
    }

    public function getPropTitle(): ?string
    {
        return $this->propTitle;
    }

    public function setPropTitle(string $propTitle): static
    {
        $this->propTitle = $propTitle;

        return $this;
    }

    public function getPropDescription(): ?string
    {
        return $this->propDescription;
    }

    public function setPropDescription(string $propDescription): static
    {
        $this->propDescription = $propDescription;

        return $this;
    }

    public function getAgentImmobilier(): ?User
    {
        return $this->AgentImmobilier;
    }

    public function setAgentImmobilier(?User $AgentImmobilier): static
    {
        $this->AgentImmobilier = $AgentImmobilier;

        return $this;
    }

    /**
     * @return Collection<int, Amenity>
     */
    public function getAmenities(): Collection
    {
        return $this->amenities;
    }

    public function addAmenity(Amenity $amenity): static
    {
        if (!$this->amenities->contains($amenity)) {
            $this->amenities->add($amenity);
            $amenity->setProperty($this);
        }

        return $this;
    }

    public function removeAmenity(Amenity $amenity): static
    {
        if ($this->amenities->removeElement($amenity)) {
            // set the owning side to null (unless already changed)
            if ($amenity->getProperty() === $this) {
                $amenity->setProperty(null);
            }
        }

        return $this;
    }

    public function getPropLongitude(): ?string
    {
        return $this->propLongitude;
    }

    public function setPropLongitude(?string $propLongitude): static
    {
        $this->propLongitude = $propLongitude;

        return $this;
    }

    public function getPropLatitude(): ?string
    {
        return $this->propLatitude;
    }

    public function setPropLatitude(?string $propLatitude): static
    {
        $this->propLatitude = $propLatitude;

        return $this;
    }

}
