<?php

namespace App\Entity;

use App\Entity\Trait\DateTrait;
use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    use DateTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $format = null;

    #[ORM\Column(nullable: true)]
    private ?int $hauteur = null;

    #[ORM\Column(nullable: true)]
    private ?int $largeur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dimensions = null;

    #[ORM\ManyToMany(targetEntity: Contenus::class, inversedBy: 'images')]
    private Collection $contenus;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[Assert\Image()]
    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'image', size: 'size', mimeType: 'type', dimensions: 'dimensions')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?int $size = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column]
    private bool $isPeripherique = false;

    public function __construct()
    {
        $this->contenus = new ArrayCollection();
    }

    public function __toString(): string
    {
        return "Image : " . $this->titre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(?string $format): static
    {
        $this->format = $format;

        return $this;
    }

    public function getHauteur(): ?int
    {
        return $this->hauteur;
    }

    public function setHauteur(?int $hauteur): static
    {
        $this->hauteur = $hauteur;

        return $this;
    }

    public function getLargeur(): ?int
    {
        return $this->largeur;
    }

    public function setLargeur(?int $largeur): static
    {
        $this->largeur = $largeur;

        return $this;
    }

    public function getDimensions(): ?string
    {
        return $this->dimensions;
    }

    public function setDimensions($dimensions): static
    {
        if (is_array($dimensions)) {
            $this->dimensions = implode("x", $dimensions);
            [$this->largeur, $this->hauteur] = $dimensions;
        } else {
            $this->dimensions = $dimensions;
        }
        return $this;
    }

    public function addContenu(Contenus $contenu): static
    {
        if (!$this->contenus->contains($contenu)) {
            $this->contenus->add($contenu);
        }

        return $this;
    }

    public function removeContenu(Contenus $contenu): static
    {
        $this->contenus->removeElement($contenu);

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getSizeKo(): ?string
    {
        if ($this->size === null)
            return $this->size;
        $kb = $this->size / 1024;
        if ($kb < 1000) {
            return round($kb, 2) . ' Kb';
        }
        return round($kb / 1024, 2) . ' Mb';
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setTitreDefault($event): static
    {
        if ($this->titre === null) {
            $this->titre = $this->getImageFile()?->getClientOriginalName();
        }
        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
        if (null !== $imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    // Fonction qui permet de savoir sur quel type de contenu est accroché l'image
    public function getUsedBy(): string
    {
        if ($this->isPeripherique) {
            return "Thème";
        }
        $contenus = $this->getContenus();
        $types = [];
        foreach ($contenus as $contenu) {
            $types[] = $contenu->getType();
        }
        $types = array_unique($types);
        $typesLabel = array_flip(Contenus::TYPES);
        foreach ($types as $k => $type) {
            $types[$k] = $typesLabel[$type];
        }
        return implode(', ', $types);
    }

    /**
     * @return Collection<int, Contenus>
     */
    public function getContenus(): Collection
    {
        return $this->contenus;
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

    // Fonction qui permet de savoir sur quelles pages est utilisé l'image
    public function onPage(): string
    {
        $contenus = $this->getContenus();
        $pages = [];
        $pagesNames = [];
        foreach ($contenus as $contenu) {
            $pages[] = $contenu->getPages();
        }

        foreach ($pages as $listPages) {
            foreach ($listPages as $page) {
                $pagesNames[] = $page->getNom();
            }
        }
        $pagesNames = array_unique($pagesNames);
        return implode(', ', $pagesNames);
    }

    public function isIsPeripherique(): bool
    {
        return $this->isPeripherique;
    }

    public function setIsPeripherique(bool $isPeripherique): static
    {
        $this->isPeripherique = $isPeripherique;

        return $this;
    }
}
