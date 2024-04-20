<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $proj_client = null;

    #[ORM\Column(nullable: true)]
    private ?int $proj_price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $proj_category = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $proj_date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $proj_facebook = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $proj_twitter = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $proj_linkedin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $proj_instagram = null;

    #[ORM\Column(length: 255)]
    private ?string $proj_title = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjClient(): ?string
    {
        return $this->proj_client;
    }

    public function setProjClient(?string $proj_client): static
    {
        $this->proj_client = $proj_client;

        return $this;
    }

    public function getProjPrice(): ?int
    {
        return $this->proj_price;
    }

    public function setProjPrice(?int $proj_price): static
    {
        $this->proj_price = $proj_price;

        return $this;
    }

    public function getProjCategory(): ?string
    {
        return $this->proj_category;
    }

    public function setProjCategory(?string $proj_category): static
    {
        $this->proj_category = $proj_category;

        return $this;
    }

    public function getProjDate(): ?\DateTimeInterface
    {
        return $this->proj_date;
    }

    public function setProjDate(?\DateTimeInterface $proj_date): static
    {
        $this->proj_date = $proj_date;

        return $this;
    }

    public function getProjFacebook(): ?string
    {
        return $this->proj_facebook;
    }

    public function setProjFacebook(?string $proj_facebook): static
    {
        $this->proj_facebook = $proj_facebook;

        return $this;
    }

    public function getProjTwitter(): ?string
    {
        return $this->proj_twitter;
    }

    public function setProjTwitter(?string $proj_twitter): static
    {
        $this->proj_twitter = $proj_twitter;

        return $this;
    }

    public function getProjLinkedin(): ?string
    {
        return $this->proj_linkedin;
    }

    public function setProjLinkedin(?string $proj_linkedin): static
    {
        $this->proj_linkedin = $proj_linkedin;

        return $this;
    }

    public function getProjInstagram(): ?string
    {
        return $this->proj_instagram;
    }

    public function setProjInstagram(?string $proj_instagram): static
    {
        $this->proj_instagram = $proj_instagram;

        return $this;
    }

    public function getProjTitle(): ?string
    {
        return $this->proj_title;
    }

    public function setProjTitle(string $proj_title): static
    {
        $this->proj_title = $proj_title;

        return $this;
    }
}
