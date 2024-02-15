<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Encoder\JsonDecode;

#[ORM\Entity(repositoryClass: TacheRepository::class)]
class Tache
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $budget = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_facture = null;

    #[ORM\Column(nullable: true)]
    private ?float $montant_facture = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_acompte = null;

    #[ORM\Column(nullable: true)]
    private ?float $montant_acompte = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;


    #[ORM\ManyToOne(inversedBy: 'tache', cascade: ['persist'],fetch: 'EAGER')]
    private ?Artisan $artisan = null;

    #[ORM\ManyToOne(inversedBy: 'taches')]
    private ?Projet $projet = null;


//    public function __construct()
//    {
//        $this->artisan = new ArrayCollection();
////        $jsonContent = $serializer->serialize($person, 'json');
//    }

//    public function __toString()
//    {
//        if($this->artisan==!null){
//            return $this->artisan->getNomEtablissement();
//        }
//        else{
//            return 'etablissement non reference';
//        }
//
//    }


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

    public function getBudget(): ?string
    {
        return $this->budget;
    }

    public function setBudget(?string $budget): static
    {
        $this->budget = $budget;

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

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(?\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;

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

    public function getDateAcompte(): ?\DateTimeInterface
    {
        return $this->date_acompte;
    }

    public function setDateAcompte(?\DateTimeInterface $date_acompte): static
    {
        $this->date_acompte = $date_acompte;

        return $this;
    }

    public function getMontantAcompte(): ?float
    {
        return $this->montant_acompte;
    }

    public function setMontantAcompte(?float $montant_acompte): static
    {
        $this->montant_acompte = $montant_acompte;

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


    public function getArtisan(): ?Artisan
    {
        return $this->artisan;
    }

    public function setArtisan(?Artisan $artisan): static
    {
        $this->artisan = $artisan;

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


}
