<?php

namespace App\Entity\Traits;


use Doctrine\ORM\Mapping as ORM;

Trait TimestampTraits
{
    #[ORM\Column(type: 'datetime_immutable', options: ['default'=> 'CURRENT_TIMESTAMP'], nullable: true)]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type:'datetime_immutable', options: ['default'=> 'CURRENT_TIMESTAMP'], nullable: true)]
    private ?\DateTimeInterface $updatedAt;

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt(\DateTimeInterface $createdAt): void
    {
        $this->createdAt = new \DateTimeImmutable;
        
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    #[ORM\PreUpdate]
    public function setUpdatedAt(\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = new \DateTimeImmutable;
    }
}