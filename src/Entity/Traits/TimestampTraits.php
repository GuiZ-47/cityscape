<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait TimestampTraits
{
    #[ORM\Column(type: 'datetime_immutable', options: ['default'=> 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime_immutable', options: ['default'=> 'CURRENT_TIMESTAMP'], nullable: true)]
    private ?\DateTimeInterface $updatedAt;

    #[ORM\Column(type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'], nullable: true)]
    private ?\DateTimeInterface $deletedAt;

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt(): void
    {
        $this->createdAt = new \DateTimeImmutable;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    #[ORM\PreUpdate]
    public function setUpdatedAt(): void
    {
        $this->updatedAt = new \DateTimeImmutable;
    }
    
    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    #[ORM\PreRemove]
    public function setDeletedAt(): void
    {
        $this->deletedAt = new \DateTimeImmutable();
    }
}