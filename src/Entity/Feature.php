<?php

namespace App\Entity;

use App\Repository\FeatureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FeatureRepository::class)]
class Feature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $feat_title = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Property $feat_property = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFeatTitle(): ?string
    {
        return $this->feat_title;
    }

    public function setFeatTitle(string $feat_title): static
    {
        $this->feat_title = $feat_title;

        return $this;
    }

    public function getFeatProperty(): ?Property
    {
        return $this->feat_property;
    }

    public function setFeatProperty(?Property $feat_property): static
    {
        $this->feat_property = $feat_property;

        return $this;
    }
}
