<?php

namespace App\Entity;

use App\Repository\PeripheriquesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeripheriquesRepository::class)]
class Peripheriques
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_entreprise = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $raison_sociale = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numero_rue = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rue = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code_postal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $localite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $capital_social = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $linkedIn = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $facebook = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $twiter = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $horaire_matin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $horaire_pm = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $jours_fermes = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $a_propos_menu_lat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre1_menu_lat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre2_menu_lat = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $texte_menu_lat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre1_home = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre2_home = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre3_home = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $titre_pied_page = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $couleur_initale_bg = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $couleur_actuelle_bg = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_modification = null;

    #[ORM\ManyToOne(targetEntity: Image::class, fetch: 'EAGER')]
    private ?Image $logo = null;

    #[ORM\ManyToOne]
    private ?Image $image1_carouselHome = null;

    #[ORM\ManyToOne]
    private ?Image $image2_carouselHome = null;

    #[ORM\ManyToOne]
    private ?Image $image3_carouselHome = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre3_menu_lat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre_footer = null;

    #[ORM\Column(nullable: true)]
    private ?array $themes_pied_page = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre_header = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $footer_about = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNomEntreprise(): ?string
    {
        return $this->nom_entreprise;
    }

    public function setNomEntreprise(?string $nom_entreprise): static
    {
        $this->nom_entreprise = $nom_entreprise;

        return $this;
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

    public function getCapitalSocial(): ?string
    {
        return $this->capital_social;
    }

    public function setCapitalSocial(?string $capital_social): static
    {
        $this->capital_social = $capital_social;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getLinkedIn(): ?string
    {
        return $this->linkedIn;
    }

    public function setLinkedIn(?string $linkedIn): static
    {
        $this->linkedIn = $linkedIn;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): static
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getTwiter(): ?string
    {
        return $this->twiter;
    }

    public function setTwiter(?string $twiter): static
    {
        $this->twiter = $twiter;

        return $this;
    }

    public function getHoraireMatin(): ?string
    {
        return $this->horaire_matin;
    }

    public function setHoraireMatin(?string $horaire_matin): static
    {
        $this->horaire_matin = $horaire_matin;

        return $this;
    }

    public function getHorairePm(): ?string
    {
        return $this->horaire_pm;
    }

    public function setHorairePm(?string $horaire_pm): static
    {
        $this->horaire_pm = $horaire_pm;

        return $this;
    }

    public function getJoursFermes(): ?string
    {
        return $this->jours_fermes;
    }

    public function setJoursFermes(?string $jours_fermes): static
    {
        $this->jours_fermes = $jours_fermes;

        return $this;
    }

    public function getAProposMenuLat(): ?string
    {
        return $this->a_propos_menu_lat;
    }

    public function setAProposMenuLat(?string $a_propos_menu_lat): static
    {
        $this->a_propos_menu_lat = $a_propos_menu_lat;

        return $this;
    }

    public function getTitre1MenuLat(): ?string
    {
        return $this->titre1_menu_lat;
    }

    public function setTitre1MenuLat(?string $titre1_menu_lat): static
    {
        $this->titre1_menu_lat = $titre1_menu_lat;

        return $this;
    }

    public function getTitre2MenuLat(): ?string
    {
        return $this->titre2_menu_lat;
    }

    public function setTitre2MenuLat(?string $titre2_menu_lat): static
    {
        $this->titre2_menu_lat = $titre2_menu_lat;

        return $this;
    }

    public function getTexteMenuLat(): ?string
    {
        return $this->texte_menu_lat;
    }

    public function setTexteMenuLat(?string $texte_menu_lat): static
    {
        $this->texte_menu_lat = $texte_menu_lat;

        return $this;
    }

    public function getTitre1Home(): ?string
    {
        return $this->titre1_home;
    }

    public function setTitre1Home(?string $titre1_home): static
    {
        $this->titre1_home = $titre1_home;

        return $this;
    }

    public function getTitre2Home(): ?string
    {
        return $this->titre2_home;
    }

    public function setTitre2Home(?string $titre2_home): static
    {
        $this->titre2_home = $titre2_home;

        return $this;
    }

    public function getTitre3Home(): ?string
    {
        return $this->titre3_home;
    }

    public function setTitre3Home(?string $titre3_home): static
    {
        $this->titre3_home = $titre3_home;

        return $this;
    }

    public function getTitrePiedPage(): ?string
    {
        return $this->titre_pied_page;
    }

    public function setTitrePiedPage(string $titre_pied_page): static
    {
        $this->titre_pied_page = $titre_pied_page;

        return $this;
    }


    public function getCouleurInitaleBg(): ?string
    {
        return $this->couleur_initale_bg;
    }

    public function setCouleurInitaleBg(?string $couleur_initale_bg): static
    {
        $this->couleur_initale_bg = $couleur_initale_bg;

        return $this;
    }

    public function getCouleurActuelleBg(): ?string
    {
        return $this->couleur_actuelle_bg;
    }

    public function setCouleurActuelleBg(?string $couleur_actuelle_bg): static
    {
        $this->couleur_actuelle_bg = $couleur_actuelle_bg;

        return $this;
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->date_modification;
    }

    public function setDateModification(?\DateTimeInterface $date_modification): static
    {
        $this->date_modification = $date_modification;

        return $this;
    }

    public function getLogo(): ?Image
    {
        return $this->logo;
    }

    public function setLogo(?Image $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getImage1CarouselHome(): ?Image
    {
        return $this->image1_carouselHome;
    }

    public function setImage1CarouselHome(?Image $image1_carouselHome): static
    {
        $this->image1_carouselHome = $image1_carouselHome;

        return $this;
    }

    public function getImage2CarouselHome(): ?Image
    {
        return $this->image2_carouselHome;
    }

    public function setImage2CarouselHome(?Image $image2_carouselHome): static
    {
        $this->image2_carouselHome = $image2_carouselHome;

        return $this;
    }

    public function getImage3CarouselHome(): ?Image
    {
        return $this->image3_carouselHome;
    }

    public function setImage3CarouselHome(?Image $image3_carouselHome): static
    {
        $this->image3_carouselHome = $image3_carouselHome;

        return $this;
    }

    public function getTitre3MenuLat(): ?string
    {
        return $this->titre3_menu_lat;
    }

    public function setTitre3MenuLat(?string $titre3_menu_lat): static
    {
        $this->titre3_menu_lat = $titre3_menu_lat;

        return $this;
    }

    public function getTitreFooter(): ?string
    {
        return $this->titre_footer;
    }

    public function setTitreFooter(?string $titre_footer): static
    {
        $this->titre_footer = $titre_footer;

        return $this;
    }

    public function getThemesPiedPage(): ?array
    {
        return $this->themes_pied_page;
    }

    public function setThemesPiedPage(?array $themes_pied_page): static
    {
        $this->themes_pied_page = $themes_pied_page;

        return $this;
    }

    public function getTitreHeader(): ?string
    {
        return $this->titre_header;
    }

    public function setTitreHeader(?string $titre_header): static
    {
        $this->titre_header = $titre_header;

        return $this;
    }

    public function getFooterAbout(): ?string
    {
        return $this->footer_about;
    }

    public function setFooterAbout(?string $footer_about): static
    {
        $this->footer_about = $footer_about;

        return $this;
    }

}
