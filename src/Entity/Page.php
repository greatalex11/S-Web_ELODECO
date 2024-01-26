<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

#[ORM\Entity(repositoryClass: PageRepository::class)]
class Page
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaires = null;

    #[ORM\ManyToMany(targetEntity: Contenus::class, mappedBy: 'pages',fetch: 'EAGER')]
    private Collection $contenus;

    #[ORM\ManyToMany(targetEntity: Style::class, mappedBy: 'page')]
    private Collection $style;

    public function __construct()
    {
        $this->contenus = new ArrayCollection();
        $this->style= new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCommentaires(): ?string
    {
        return $this->commentaires;
    }

    public function setCommentaires(?string $commentaires): static
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    /**
     * @return Collection<int, Contenus>
     */
    public function getContenus(): Collection
    {
        return $this->contenus;
    }

    public function getNbContenus(): Int
    {
        return $this->contenus->count();
    }
    public function addContenu(Contenus $contenu): static
    {
        if (!$this->contenus->contains($contenu)) {
            $this->contenus->add($contenu);
            $contenu->addPage($this);
        }

        return $this;
    }

    public function removeContenu(Contenus $contenu): static
    {
        if ($this->contenus->removeElement($contenu)) {
            $contenu->removePage($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Style>
     */
    public function getStyle(): Collection
    {
        return $this->style;
    }

    public function addStyle(Style $style): static
    {
        if (!$this->style->contains($style)) {
            $this->style->add($style);
            $style->addPage($this);
        }

        return $this;
    }

    public function removeStyle(Style $style): static
    {
        if ($this->style->removeElement($style)) {
            $style->removePage($this);
        }

        return $this;
    }
}
