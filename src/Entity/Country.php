<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ct_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCtName(): ?string
    {
        return $this->ct_name;
    }

    public function setCtName(string $ct_name): static
    {
        $this->ct_name = $ct_name;

        return $this;
    }
}
