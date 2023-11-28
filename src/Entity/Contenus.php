<?php

namespace App\Entity;

use App\Repository\ContenusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContenusRepository::class)]
class Contenus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $titre1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre3 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $texte1 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $texte2 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $texte3 = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\ManyToMany(targetEntity: Image::class, mappedBy: 'contenu')]
    private Collection $images;

    #[ORM\ManyToMany(targetEntity: Page::class, inversedBy: 'contenus')]
    private Collection $page;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->page = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getTitre1(): ?string
    {
        return $this->titre1;
    }

    public function setTitre1(string $titre1): static
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

    public function getTitre3(): ?string
    {
        return $this->titre3;
    }

    public function setTitre3(?string $titre3): static
    {
        $this->titre3 = $titre3;

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

    public function getTexte2(): ?string
    {
        return $this->texte2;
    }

    public function setTexte2(?string $texte2): static
    {
        $this->texte2 = $texte2;

        return $this;
    }

    public function getTexte3(): ?string
    {
        return $this->texte3;
    }

    public function setTexte3(?string $texte3): static
    {
        $this->texte3 = $texte3;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(?\DateTimeInterface $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->addContenu($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            $image->removeContenu($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Page>
     */
    public function getPage(): Collection
    {
        return $this->page;
    }

    public function addPage(Page $page): static
    {
        if (!$this->page->contains($page)) {
            $this->page->add($page);
        }

        return $this;
    }

    public function removePage(Page $page): static
    {
        $this->page->removeElement($page);

        return $this;
    }
}
