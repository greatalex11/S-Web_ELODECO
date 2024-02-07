<?php

namespace App\Entity;

use App\Repository\StyleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StyleRepository::class)]
class Style
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $attribut1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $attribut2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $attribut3 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $texte1 = null;

    #[ORM\Column(nullable: true)]
    private ?array $liste = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $texte2 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $publier = null;

   #[ORM\ManyToMany(targetEntity: Image::class, inversedBy: 'styles', cascade: ['persist'], fetch: 'EAGER')]
    private Collection $image;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    public function __construct()
    {
        $this->page = new ArrayCollection();
        $this->image = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre1(): ?string
    {
        return $this->titre1;
    }

    public function setTitre1(?string $titre1): static
    {
        $this->titre1 = $titre1;

        return $this;
    }

    public function getTitre2(): ?string
    {
        return $this->titre2;
    }

    public function setTitre2(?string $titre2): static
    {
        $this->titre2 = $titre2;

        return $this;
    }

    public function getAttribut1(): ?string
    {
        return $this->attribut1;
    }

    public function setAttribut1(?string $attribut1): static
    {
        $this->attribut1 = $attribut1;

        return $this;
    }

    public function getAttribut2(): ?string
    {
        return $this->attribut2;
    }

    public function setAttribut2(?string $attribut2): static
    {
        $this->attribut2 = $attribut2;

        return $this;
    }

    public function getAttribut3(): ?string
    {
        return $this->attribut3;
    }

    public function setAttribut3(?string $attribut3): static
    {
        $this->attribut3 = $attribut3;

        return $this;
    }

    public function getTexte1(): ?string
    {
        return $this->texte1;
    }

    public function setTexte1(?string $texte1): static
    {
        $this->texte1 = $texte1;

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

    public function getTexte2(): ?string
    {
        return $this->texte2;
    }

    public function setTexte2(?string $texte2): static
    {
        $this->texte2 = $texte2;

        return $this;
    }

    public function isPublier(): ?bool
    {
        return $this->publier;
    }

    public function setPublier(?bool $publier): static
    {
        $this->publier = $publier;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
