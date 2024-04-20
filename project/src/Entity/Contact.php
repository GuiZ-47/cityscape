<?php

namespace App\Entity;

class Contact
{
    private ?string $contName = null;
   
    private ?string $contEmail = null;

    private ?string $contPhoneNumber = null;

    private ?string $contSubject = null;

    private ?string $contMessage = null;

    public function getContName(): ?string
    {
        return $this->contName;
    }

    public function setContName(string $contName): self
    {
        $this->contName = $contName;

        return $this;
    }

    public function getContEmail(): ?string
    {
        return $this->contEmail;
    }

    public function setContEmail(string $contEmail): self
    {
        $this->contEmail = $contEmail;

        return $this;
    }

    public function getContPhoneNumber(): ?string
    {
        return $this->contPhoneNumber;
    }

    public function setContPhoneNumber(?string $contPhoneNumber): self
    {
        $this->contPhoneNumber = $contPhoneNumber;

        return $this;
    }

    public function getContSubject(): ?string
    {
        return $this->contSubject;
    }

    public function setContSubject(string $contSubject): self
    {
        $this->contSubject = $contSubject;

        return $this;
    }

    public function getContMessage(): ?string
    {
        return $this->contMessage;
    }

    public function setContMessage(string $contMessage): self
    {
        $this->contMessage = $contMessage;

        return $this;
    }
}
