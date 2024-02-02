<?php

namespace App\Entity;

use App\Repository\AboutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AboutRepository::class)]
class About
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $visiot1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $visiot2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $visioarg1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $visioarg2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $visioarg3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $visioarg4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $visiot3 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $visiotexte1 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $visiotexte2 = null;

    #[ORM\Column(nullable: true)]
    private ?int $visiochiffre1 = null;

    #[ORM\Column(nullable: true)]
    private ?int $visiochiffre2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $expertt1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $expertt2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $expertt3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $expertt4 = null;

    #[ORM\ManyToMany(targetEntity: Image::class, inversedBy: 'abouts',cascade: ['persist'],fetch: 'EAGER')]
    private Collection $image;

    public function __construct()
    {
        $this->image = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVisiot1(): ?string
    {
        return $this->visiot1;
    }

    public function setVisiot1(?string $visiot1): static
    {
        $this->visiot1 = $visiot1;

        return $this;
    }

    public function getVisiot2(): ?string
    {
        return $this->visiot2;
    }

    public function setVisiot2(?string $visiot2): static
    {
        $this->visiot2 = $visiot2;

        return $this;
    }

    public function getVisioarg1(): ?string
    {
        return $this->visioarg1;
    }

    public function setVisioarg1(?string $visioarg1): static
    {
        $this->visioarg1 = $visioarg1;

        return $this;
    }

    public function getVisioarg2(): ?string
    {
        return $this->visioarg2;
    }

    public function setVisioarg2(?string $visioarg2): static
    {
        $this->visioarg2 = $visioarg2;

        return $this;
    }

    public function getVisioarg3(): ?string
    {
        return $this->visioarg3;
    }

    public function setVisioarg3(?string $visioarg3): static
    {
        $this->visioarg3 = $visioarg3;

        return $this;
    }

    public function getVisioarg4(): ?string
    {
        return $this->visioarg4;
    }

    public function setVisioarg4(?string $visioarg4): static
    {
        $this->visioarg4 = $visioarg4;

        return $this;
    }

    public function getVisiot3(): ?string
    {
        return $this->visiot3;
    }

    public function setVisiot3(?string $visiot3): static
    {
        $this->visiot3 = $visiot3;

        return $this;
    }

    public function getVisiotexte1(): ?string
    {
        return $this->visiotexte1;
    }

    public function setVisiotexte1(?string $visiotexte1): static
    {
        $this->visiotexte1 = $visiotexte1;

        return $this;
    }

    public function getVisiotexte2(): ?string
    {
        return $this->visiotexte2;
    }

    public function setVisiotexte2(?string $visiotexte2): static
    {
        $this->visiotexte2 = $visiotexte2;

        return $this;
    }

    public function getVisiochiffre1(): ?int
    {
        return $this->visiochiffre1;
    }

    public function setVisiochiffre1(?int $visiochiffre1): static
    {
        $this->visiochiffre1 = $visiochiffre1;

        return $this;
    }

    public function getVisiochiffre2(): ?int
    {
        return $this->visiochiffre2;
    }

    public function setVisiochiffre2(?int $visiochiffre2): static
    {
        $this->visiochiffre2 = $visiochiffre2;

        return $this;
    }

    public function getExpertt1(): ?string
    {
        return $this->expertt1;
    }

    public function setExpertt1(?string $expertt1): static
    {
        $this->expertt1 = $expertt1;

        return $this;
    }

    public function getExpertt2(): ?string
    {
        return $this->expertt2;
    }

    public function setExpertt2(?string $expertt2): static
    {
        $this->expertt2 = $expertt2;

        return $this;
    }

    public function getExpertt3(): ?string
    {
        return $this->expertt3;
    }

    public function setExpertt3(?string $expertt3): static
    {
        $this->expertt3 = $expertt3;

        return $this;
    }

    public function getExpertt4(): ?string
    {
        return $this->expertt4;
    }

    public function setExpertt4(?string $expertt4): static
    {
        $this->expertt4 = $expertt4;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(Image $image): static
    {
        if (!$this->image->contains($image)) {
            $this->image->add($image);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        $this->image->removeElement($image);

        return $this;
    }
}
