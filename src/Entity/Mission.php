<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MissionRepository::class)]
class Mission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $missiont1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $missiont2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $missionarg1 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $missiontexte1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $missiont3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $missiont4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $missionarg3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $missionarg4 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $missiontexte2 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $missiontexte3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $missiont5 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $missiont6 = null;

    #[ORM\Column(nullable: true)]
    private ?array $liste = null;

    #[ORM\ManyToMany(targetEntity: Image::class, inversedBy: 'missions')]
    private Collection $image;

    public function __construct()
    {
        $this->image = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMissiont1(): ?string
    {
        return $this->missiont1;
    }

    public function setMissiont1(?string $missiont1): static
    {
        $this->missiont1 = $missiont1;

        return $this;
    }

    public function getMissiont2(): ?string
    {
        return $this->missiont2;
    }

    public function setMissiont2(?string $missiont2): static
    {
        $this->missiont2 = $missiont2;

        return $this;
    }

    public function getMissionarg1(): ?string
    {
        return $this->missionarg1;
    }

    public function setMissionarg1(?string $missionarg1): static
    {
        $this->missionarg1 = $missionarg1;

        return $this;
    }

    public function getMissiontexte1(): ?string
    {
        return $this->missiontexte1;
    }

    public function setMissiontexte1(?string $missiontexte1): static
    {
        $this->missiontexte1 = $missiontexte1;

        return $this;
    }

    public function getMissiont3(): ?string
    {
        return $this->missiont3;
    }

    public function setMissiont3(?string $missiont3): static
    {
        $this->missiont3 = $missiont3;

        return $this;
    }

    public function getMissiont4(): ?string
    {
        return $this->missiont4;
    }

    public function setMissiont4(?string $missiont4): static
    {
        $this->missiont4 = $missiont4;

        return $this;
    }

    public function getMissionarg3(): ?string
    {
        return $this->missionarg3;
    }

    public function setMissionarg3(?string $missionarg3): static
    {
        $this->missionarg3 = $missionarg3;

        return $this;
    }

    public function getMissionarg4(): ?string
    {
        return $this->missionarg4;
    }

    public function setMissionarg4(?string $missionarg4): static
    {
        $this->missionarg4 = $missionarg4;

        return $this;
    }

    public function getMissiontexte2(): ?string
    {
        return $this->missiontexte2;
    }

    public function setMissiontexte2(?string $missiontexte2): static
    {
        $this->missiontexte2 = $missiontexte2;

        return $this;
    }

    public function getMissiontexte3(): ?string
    {
        return $this->missiontexte3;
    }

    public function setMissiontexte3(?string $missiontexte3): static
    {
        $this->missiontexte3 = $missiontexte3;

        return $this;
    }

    public function getMissiont5(): ?string
    {
        return $this->missiont5;
    }

    public function setMissiont5(?string $missiont5): static
    {
        $this->missiont5 = $missiont5;

        return $this;
    }

    public function getMissiont6(): ?string
    {
        return $this->missiont6;
    }

    public function setMissiont6(?string $missiont6): static
    {
        $this->missiont6 = $missiont6;

        return $this;
    }

    public function getListe(): ?array
    {
        return $this->liste;
    }

    public function setListe(?array $liste): static
    {
        $this->liste = $liste;

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
