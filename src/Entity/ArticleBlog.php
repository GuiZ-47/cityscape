<?php

namespace App\Entity;

use App\Repository\ArticleBlogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\TimestampTraits;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: ArticleBlogRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ArticleBlog
{
    use TimestampTraits;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $blogDescription = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getBlogDescription(): ?string
    {
        return $this->blogDescription;
    }

    public function setBlogDescription(string $blogDescription): static
    {
        $this->blogDescription = $blogDescription;

        return $this;
    }
}
