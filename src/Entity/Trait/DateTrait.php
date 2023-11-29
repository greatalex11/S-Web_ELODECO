<?php

namespace App\Entity\Trait;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

trait DateTrait
{

    #[ORM\Column]
    private ?DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $updatedAt = null;

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt($event): static
    {
        $this->createdAt = $this->updatedAt = new DateTimeImmutable();
        return $this;
    }


    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    #[ORM\PreUpdate]
    public function setUpdatedAt($event): static
    {
        $this->updatedAt = new DateTimeImmutable();

        return $this;
    }
}
