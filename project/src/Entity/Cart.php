<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\TimestampTraits;
use Doctrine\ORM\Mapping\Table;

#[ORM\Entity(repositoryClass: CartRepository::class)]
#[Table('location')]
#[ORM\HasLifecycleCallbacks]
class Cart
{
    use TimestampTraits;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $StripeId = null;

    #[ORM\ManyToOne(inversedBy: 'carts')]
    private ?User $User = null;

    #[ORM\ManyToMany(targetEntity: Property::class, inversedBy: 'carts')]
    private Collection $Property;

    public function __construct()
    {
        $this->Property = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStripeId(): ?string
    {
        return $this->StripeId;
    }

    public function setStripeId(string $StripeId): static
    {
        $this->StripeId = $StripeId;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return Collection<int, Property>
     */
    public function getProperty(): Collection
    {
        return $this->Property;
    }

    public function addProperty(Property $property): static
    {
        if (!$this->Property->contains($property)) {
            $this->Property->add($property);
        }

        return $this;
    }

    public function removeProperty(Property $property): static
    {
        $this->Property->removeElement($property);

        return $this;
    }
}
