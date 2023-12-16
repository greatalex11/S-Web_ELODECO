<?php

namespace App\Entity;

use App\Entity\Trait\DateTrait;
use App\Repository\ContenusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContenusRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Contenus
{

    public const TYPE_NewsGTI= 'NewsGTI';
    public const TYPE_ServicesGTI= 'ServicesGTI';

    public const TYPE_PortefolioGTI= 'PortefolioGTI';
    public const TYPE_COMPTEURS = 'compteurs';
    public const TYPE_TARIFS = 'tarifs';
    public const TYPE_BLOGN = 'blogNews';
    public const TYPE_BLOGAC = 'blogAboutConcept';
    public const TYPE_BLOGACP = 'blogAboutConceptPrix';
    public const TYPE_BLOGAE = 'blogAboutExpert';
    public const TYPE_BLOGAL = 'blogenL';
    public const TYPE_BLOGAT = 'blogTemoins';
    public const TYPE_BLOGF = 'blogFolio';
    public const TYPE_BLOGS = 'blogService';
    public const TYPE_3SERVICES = '3Services';
    public const TYPE_3SERVICESPRO = '3ServicesPRO';
    public const TYPE_1SERVICEPRO = '1ServicesPRO';
    public const TYPE_3SERVICESQUALITE = '3ServicesQUALITE';
    public const TYPE_PHOTOGP = 'BlockPhotos';
    public const TYPE_SERVICEDETAIL= '6clefsServiceDetails';


    public const TYPES = [
        'NewsGti' => self::TYPE_NewsGTI,
        'ServicesGti' => self::TYPE_ServicesGTI,
        'PortefolioGTI' => self::TYPE_PortefolioGTI,
        'News' => self::TYPE_BLOGN,
        'Folio' => self::TYPE_BLOGF,
        'Service' => self::TYPE_BLOGS,
        'Compteurs' => self::TYPE_COMPTEURS,
        '3 Services' => self::TYPE_3SERVICES,
        '3 Services PRO' => self::TYPE_3SERVICESPRO,
        '1 Service PRO' => self::TYPE_1SERVICEPRO,
        '3 Services QUALITE' => self::TYPE_3SERVICESQUALITE,
        'About concept' => self::TYPE_BLOGAC,
        'About concept Prix' => self::TYPE_BLOGACP,
        'About expert' => self::TYPE_BLOGAE,
        'About pub en L' => self::TYPE_BLOGAL,
        'About Temoins' => self::TYPE_BLOGAT,
        'Block photos' => self::TYPE_PHOTOGP,
        'tarif à la carte'=> self::TYPE_TARIFS,
        '6 clefs services détails'=> self::TYPE_SERVICEDETAIL,

    ];

    use DateTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
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

    #[ORM\ManyToMany(targetEntity: Image::class, mappedBy: 'contenus', cascade: ['persist'], fetch: 'EAGER')]
    #[Assert\Valid()]
    private Collection $images;

    #[ORM\ManyToMany(targetEntity: Page::class, inversedBy: 'contenus',fetch: 'EAGER')]
    private Collection $pages;

    #[ORM\Column(nullable: true)]
    private ?bool $publier = false;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $liste = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->pages = new ArrayCollection();
    }

    public function __toString(): string
    {
        return "Contenu #" . $this->getId();
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
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(Page $page): static
    {
        if (!$this->pages->contains($page)) {
            $this->pages->add($page);
        }

        return $this;
    }

    public function removePage(Page $page): static
    {
        $this->pages->removeElement($page);

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

    public function getListe(): ?array
    {
        return $this->liste;
    }

    public function setListe(?array $liste): static
    {
        $this->liste = array_values($liste);

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
