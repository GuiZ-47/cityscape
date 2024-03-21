<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $contName = null;

    #[ORM\Column(length: 255)]
    private ?string $contEmail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contPhoneNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $contSubject = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contMessage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContName(): ?string
    {
        return $this->contName;
    }

    public function setContName(string $contName): static
    {
        $this->contName = $contName;

        return $this;
    }

    public function getContEmail(): ?string
    {
        return $this->contEmail;
    }

    public function setContEmail(string $contEmail): static
    {
        $this->contEmail = $contEmail;

        return $this;
    }

    public function getContPhoneNumber(): ?string
    {
        return $this->contPhoneNumber;
    }

    public function setContPhoneNumber(?string $contPhoneNumber): static
    {
        $this->contPhoneNumber = $contPhoneNumber;

        return $this;
    }

    public function getContSubject(): ?string
    {
        return $this->contSubject;
    }

    public function setContSubject(string $contSubject): static
    {
        $this->contSubject = $contSubject;

        return $this;
    }

    public function getContMessage(): ?string
    {
        return $this->contMessage;
    }

    public function setContMessage(string $contMessage): static
    {
        $this->contMessage = $contMessage;

        return $this;
    }
}
