<?php

namespace App\Entity;

use App\Repository\ArtisanRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtisanRepository::class)]
class Artisan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $raison_sociale = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nom_etablissement = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $siret = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nom_gerant = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $prenom_gerant = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?DateTimeInterface $date_naissance = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $numero_rue = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $code_postal = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $localite = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $tel_fixe = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $tel_portable = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $fax = null;

    #[ORM\Column(nullable: true)]
    private ?int $note_globale = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $status = null;

    #[ORM\OneToOne(inversedBy: 'artisan', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaisonSociale(): ?string
    {
        return $this->raison_sociale;
    }

    public function setRaisonSociale(?string $raison_sociale): static
    {
        $this->raison_sociale = $raison_sociale;

        return $this;
    }

    public function getNomEtablissement(): ?string
    {
        return $this->nom_etablissement;
    }

    public function setNomEtablissement(?string $nom_etablissement): static
    {
        $this->nom_etablissement = $nom_etablissement;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function getNomGerant(): ?string
    {
        return $this->nom_gerant;
    }

    public function setNomGerant(?string $nom_gerant): static
    {
        $this->nom_gerant = $nom_gerant;

        return $this;
    }

    public function getPrenomGerant(): ?string
    {
        return $this->prenom_gerant;
    }

    public function setPrenomGerant(?string $prenom_gerant): static
    {
        $this->prenom_gerant = $prenom_gerant;

        return $this;
    }

    public function getDateNaissance(): ?DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(?DateTimeInterface $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }


    public function getNumeroRue(): ?string
    {
        return $this->numero_rue;
    }

    public function setNumeroRue(string $numero_rue): static
    {
        $this->numero_rue = $numero_rue;

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

    public function getTelFixe(): ?string
    {
        return $this->tel_fixe;
    }

    public function setTelFixe(?string $tel_fixe): static
    {
        $this->tel_fixe = $tel_fixe;

        return $this;
    }

    public function getTelPortable(): ?string
    {
        return $this->tel_portable;
    }

    public function setTelPortable(?string $tel_portable): static
    {
        $this->tel_portable = $tel_portable;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): static
    {
        $this->fax = $fax;

        return $this;
    }

    public function getNoteGlobale(): ?int
    {
        return $this->note_globale;
    }

    public function setNoteGlobale(?int $note_globale): static
    {
        $this->note_globale = $note_globale;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
