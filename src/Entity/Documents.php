<?php

namespace App\Entity;

use App\Entity\Trait\DateTrait;
use App\Repository\DocumentsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: DocumentsRepository::class)]
class Documents
{
    use DateTrait;
    public const CLIENT= 'clients';
    public const ARTISAN= 'artisan';

    public const FACTURE= 'facture';
    public const PLAN= 'plan';
    public const DEVIS= 'devis';
    public const TITRE= 'titrePropriete';
    public const ASSUR= 'assurance';
    public const CONTRAT= 'contrat';
    public const CONSEIL= 'conseil';
    public const AUTRE= 'autre';

    public const MISEENCOPIE =[
        "Artisan"=> self::ARTISAN,
        "Client"=> self::CLIENT,
    ];
    public const TYPEDEDOCUMENT =[
        "Assurance"=> self::ASSUR,
        "Conseil"=> self::CONSEIL,
        "Contrat"=> self::CONTRAT,
        "Devis"=> self::DEVIS,
        "Facture"=> self::FACTURE,
        "Plan"=> self::PLAN,
        "Titre de propriété"=> self::TITRE,
        "Autre"=> self::AUTRE,
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_peremption = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $mise_en_copie = null;

    #[ORM\ManyToOne(cascade: ['persist'],fetch: 'EAGER',inversedBy: 'documents')]
    private ?Projet $projet = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    #[Vich\UploadableField(mapping: 'documents', fileNameProperty: 'document', size: 'size', mimeType: 'typo')]
    private ?File $documentsFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $document = null;

    #[ORM\Column(nullable: true)]
    private ?int $size = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $typo = null;

    //selection des documents par titre avec première lettre en Maj
    public function __toString(): string
    {
        return ucfirst($this->titre);
    }

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $TitreDefault = null;

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

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDatePeremption(): ?\DateTimeInterface
    {
        return $this->date_peremption;
    }

    public function setDatePeremption(\DateTimeInterface $date_peremption): static
    {
        $this->date_peremption = $date_peremption;

        return $this;
    }

    public function getMiseEnCopie(): ?array
    {
        return $this->mise_en_copie;
    }

    // traitement JSON
    public function setMiseEnCopie(?array $mise_en_copie): static
    {
        $this->mise_en_copie = array_values($mise_en_copie);
//        $this->mise_en_copie = $mise_en_copie;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): static
    {
        $this->projet = $projet;

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


    public function getDocumentsFile(): ?File
    {
        return $this->documentsFile;
    }

    public function setDocumentsFile(?File $documentsFile = null): void
    {
        $this->documentsFile = $documentsFile;
        if (null !== $documentsFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
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

    public function getTypo(): ?string
    {
        return $this->typo;
    }

    public function setTypo(?string $typo): static
    {
        $this->typo = $typo;

        return $this;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(?string $document): static
    {
        $this->document = $document;

        return $this;
    }

}
