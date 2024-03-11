<?php

namespace App\Entity;

use App\Repository\QuestionResponseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\TimestampTraits;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: QuestionResponseRepository::class)]
#[ORM\HasLifecycleCallbacks]
class QuestionResponse
{   
    use TimestampTraits;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Question = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Response = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->Question;
    }

    public function setQuestion(string $Question): static
    {
        $this->Question = $Question;

        return $this;
    }

    public function getResponse(): ?string
    {
        return $this->Response;
    }

    public function setResponse(string $Response): static
    {
        $this->Response = $Response;

        return $this;
    }
}
