<?php

namespace App\Entity;

use App\Repository\DocumentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentsRepository::class)]
class Documents
{
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

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $mise_en_copie = null;

    #[ORM\ManyToOne]
    private ?Projet $projet = null;

    #[ORM\ManyToMany(targetEntity: Client::class, inversedBy: 'documents')]
    private Collection $client;

    #[ORM\ManyToMany(targetEntity: Artisan::class, inversedBy: 'documents')]
    private Collection $artisan;

    public function __construct()
    {
        $this->client = new ArrayCollection();
        $this->artisan = new ArrayCollection();
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

    public function setMiseEnCopie(?array $mise_en_copie): static
    {
        $this->mise_en_copie = $mise_en_copie;

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

    /**
     * @return Collection<int, Artisan>
     */
    public function getArtisan(): Collection
    {
        return $this->artisan;
    }

    public function addArtisan(Artisan $artisan): static
    {
        if (!$this->artisan->contains($artisan)) {
            $this->artisan->add($artisan);
        }

        return $this;
    }

    public function removeArtisan(Artisan $artisan): static
    {
        $this->artisan->removeElement($artisan);

        return $this;
    }
}
