<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pic_file = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pic_name = null;

    #[ORM\Column(length: 255)]
    private ?string $pic_href = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pic_alt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pic_caption = null;

    #[ORM\Column(length: 255)]
    private ?string $pic_type = null;

    #[ORM\Column(length: 255)]
    private ?string $pic_format = null;

    #[ORM\Column]
    private ?int $pic_width = null;

    #[ORM\Column]
    private ?int $pic_height = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $pic_size = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Property $pic_property = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPicFile(): ?string
    {
        return $this->pic_file;
    }

    public function setPicFile(string $pic_file): static
    {
        $this->pic_file = $pic_file;

        return $this;
    }

    public function getPicName(): ?string
    {
        return $this->pic_name;
    }

    public function setPicName(?string $pic_name): static
    {
        $this->pic_name = $pic_name;

        return $this;
    }

    public function getPicHref(): ?string
    {
        return $this->pic_href;
    }

    public function setPicHref(string $pic_href): static
    {
        $this->pic_href = $pic_href;

        return $this;
    }

    public function getPicAlt(): ?string
    {
        return $this->pic_alt;
    }

    public function setPicAlt(?string $pic_alt): static
    {
        $this->pic_alt = $pic_alt;

        return $this;
    }

    public function getPicCaption(): ?string
    {
        return $this->pic_caption;
    }

    public function setPicCaption(?string $pic_caption): static
    {
        $this->pic_caption = $pic_caption;

        return $this;
    }

    public function getPicType(): ?string
    {
        return $this->pic_type;
    }

    public function setPicType(string $pic_type): static
    {
        $this->pic_type = $pic_type;

        return $this;
    }

    public function getPicFormat(): ?string
    {
        return $this->pic_format;
    }

    public function setPicFormat(string $pic_format): static
    {
        $this->pic_format = $pic_format;

        return $this;
    }

    public function getPicWidth(): ?int
    {
        return $this->pic_width;
    }

    public function setPicWidth(int $pic_width): static
    {
        $this->pic_width = $pic_width;

        return $this;
    }

    public function getPicHeight(): ?int
    {
        return $this->pic_height;
    }

    public function setPicHeight(int $pic_height): static
    {
        $this->pic_height = $pic_height;

        return $this;
    }

    public function getPicSize(): ?string
    {
        return $this->pic_size;
    }

    public function setPicSize(?string $pic_size): static
    {
        $this->pic_size = $pic_size;

        return $this;
    }

    public function getPicProperty(): ?Property
    {
        return $this->pic_property;
    }

    public function setPicProperty(?Property $pic_property): static
    {
        $this->pic_property = $pic_property;

        return $this;
    }
}
