<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{

    public const SERVICE_COMPLET= 'gestion totale du projet';

    public const SERVICE_PARTIEL= 'plans et mise en relation';


    public const prestation=[
        "gestion complète"=> self::SERVICE_COMPLET,
        "gestion" => self::SERVICE_PARTIEL,
        ];
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?string $prestation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(nullable: true)]
    private ?int $duree = null;


//    public function __toString(): string
//    {
//        return $this->client;
//    }

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numero = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rue = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code_postal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $localite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $budget = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_facture = null;

    #[ORM\Column(nullable: true)]
    private ?float $montant_facture = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_accompte = null;

    #[ORM\Column(nullable: true)]
    private ?float $montant_accompte = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: Tache::class,cascade: ['persist'],fetch: 'EAGER')]
    private Collection $taches;

    #[ORM\ManyToMany(targetEntity: Client::class, inversedBy: 'projets',fetch: 'EAGER')]
    private Collection $client;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: Documents::class,cascade: ['persist'],fetch: 'EAGER')]
    private Collection $documents;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    #[ORM\ManyToMany(targetEntity: Image::class, inversedBy: 'projets', cascade: ['persist'],fetch: 'EAGER')]
    private Collection $image;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $uniteDuree = null;

    #[ORM\Column(nullable: true)]
    private ?array $list = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $texte2 = null;

//cascade: ["persist"]

    public function __construct()
    {
        $this->taches = new ArrayCollection();
        $this->client = new ArrayCollection();
        $this->documents = new ArrayCollection();
//        $this->prestation =new ArrayCollection();
        $this->image = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrestation(): ?string
    {
        return $this->prestation;
    }

    public function setPrestation(?string $prestation): static
    {
        $this->prestation = $prestation;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(?\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(?string $rue): static
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(?string $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getLocalite(): ?string
    {
        return $this->localite;
    }

    public function setLocalite(?string $localite): static
    {
        $this->localite = $localite;

        return $this;
    }

    public function getBudget(): ?string
    {
        return $this->budget;
    }

    public function setBudget(?string $budget): static
    {
        $this->budget = $budget;

        return $this;
    }

    public function getDateFacture(): ?\DateTimeInterface
    {
        return $this->date_facture;
    }

    public function setDateFacture(?\DateTimeInterface $date_facture): static
    {
        $this->date_facture = $date_facture;

        return $this;
    }

    public function getMontantFacture(): ?float
    {
        return $this->montant_facture;
    }

    public function setMontantFacture(?float $montant_facture): static
    {
        $this->montant_facture = $montant_facture;

        return $this;
    }

    public function getDateAccompte(): ?\DateTimeInterface
    {
        return $this->date_accompte;
    }

    public function setDateAccompte(?\DateTimeInterface $date_accompte): static
    {
        $this->date_accompte = $date_accompte;

        return $this;
    }

    public function getMontantAccompte(): ?float
    {
        return $this->montant_accompte;
    }

    public function setMontantAccompte(?float $montant_accompte): static
    {
        $this->montant_accompte = $montant_accompte;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }



    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(?\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    /**
     * @return Collection<int, Tache>
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTach(Tache $tach): static
    {
        if (!$this->taches->contains($tach)) {
            $this->taches->add($tach);
            $tach->setProjet($this);
        }

        return $this;
    }

    public function removeTach(Tache $tach): static
    {
        if ($this->taches->removeElement($tach)) {
            // set the owning side to null (unless already changed)
            if ($tach->getProjet() === $this) {
                $tach->setProjet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClient(): Collection
    {
        return $this->client;
    }

    public function addClient(Client $client): static
    {
        if (!$this->client->contains($client)) {
            $this->client->add($client);
        }

        return $this;
    }

    public function removeClient(Client $client): static
    {
        $this->client->removeElement($client);

        return $this;
    }
//    public function __toString()
//    {
//        return $this->client;
//    }

    /**
     * @return Collection<int, Documents>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Documents $document): static
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->setProjet($this);
        }

        return $this;
    }

    public function removeDocument(Documents $document): static
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getProjet() === $this) {
                $document->setProjet(null);
            }
        }

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

    public function getTitre2(): ?string
    {
        return $this->titre2;
    }

    public function setTitre2(?string $titre2): static
    {
        $this->titre2 = $titre2;

        return $this;
    }

    public function getUniteDuree(): ?string
    {
        return $this->uniteDuree;
    }

    public function setUniteDuree(?string $uniteDuree): static
    {
        $this->uniteDuree = $uniteDuree;

        return $this;
    }

    public function getList(): ?array
    {
        return $this->list;
    }

    public function setList(?array $list): static
    {
        $this->list = $list;

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
}
