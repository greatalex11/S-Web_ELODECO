<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(nullable: true)]
    private ?string $numero_rue = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $rue = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $code_postal = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $localite = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $tel_fix = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $tel_portable = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?DateTimeInterface $date_naissance = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $status = null;

    #[ORM\OneToOne(inversedBy: 'client', cascade: ['persist', 'remove'],fetch: 'EAGER')]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Projet::class, mappedBy: 'client')]
    private Collection $projets;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statusMarital = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomConjoint = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenomConjoint = null;

    public function __construct()
    {
        $this->projets = new ArrayCollection();
    }


    public function __toString()
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNumeroRue(): ?string
    {
        return $this->numero_rue;
    }

    public function setNumeroRue(?string $numero_rue): static
    {
        $this->numero_rue = $numero_rue;

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

    public function getTelFix(): ?string
    {
        return $this->tel_fix;
    }

    public function setTelFix(?string $tel_fix): static
    {
        $this->tel_fix = $tel_fix;

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

    public function getDateNaissance(): ?DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(?DateTimeInterface $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

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


    /**
     * @return Collection<int, Projet>
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): static
    {
        if (!$this->projets->contains($projet)) {
            $this->projets->add($projet);
            $projet->addClient($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): static
    {
        if ($this->projets->removeElement($projet)) {
            $projet->removeClient($this);
        }

        return $this;
    }

    public function getStatusMarital(): ?string
    {
        return $this->statusMarital;
    }

    public function setStatusMarital(?string $statusMarital): static
    {
        $this->statusMarital = $statusMarital;

        return $this;
    }

    public function getNomConjoint(): ?string
    {
        return $this->nomConjoint;
    }

    public function setNomConjoint(?string $nomConjoint): static
    {
        $this->nomConjoint = $nomConjoint;

        return $this;
    }

    public function getPrenomConjoint(): ?string
    {
        return $this->prenomConjoint;
    }

    public function setPrenomConjoint(?string $prenomConjoint): static
    {
        $this->prenomConjoint = $prenomConjoint;

        return $this;
    }

}
