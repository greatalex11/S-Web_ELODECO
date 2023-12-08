<?php

namespace App\Controller\Admin;

use App\Entity\Peripheriques;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PeripheriquesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Peripheriques::class;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInPlural('Peripheriques')
            ->setEntityLabelInSingular('Peripherique')
            ->setAutofocusSearch();
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield FormField::addTab("Entreprise"),
            yield AssociationField::new('logo')
                ->setLabel('Logo de l\'entreprise au format 93x110')
                ->setColumns(4)
                ->setTemplatePath('fields/images.html.twig'),
            yield TextField::new('nom_entreprise')->setLabel('Nom de ton entreprise'),
            yield TextField::new('raison_sociale')->setLabel('raison_sociale')->hideOnIndex(),
            yield TextField::new('capital_social')->setLabel('capital social')->hideOnIndex(),
            yield TextField::new('numero_rue')->setLabel('numéro de la rue')->hideOnIndex(),
            yield TextField::new('rue')->setLabel('nom de la rue')->hideOnIndex(),
            yield TextField::new('code_postal')->setLabel('code postal')->hideOnIndex(),
            yield TextField::new('localite')->setLabel('localité')->hideOnIndex(),
            yield TextField::new('telephone')->setLabel('numéro de téléphone')->hideOnIndex(),
            yield TextField::new('mail')->setLabel('mail')->hideOnIndex(),

            yield FormField::addTab("Réseaux sociaux"),
            yield TextField::new('linked_in')->setLabel('linkedIn'),
            yield TextField::new('facebook')->setLabel('Facebook')->hideOnIndex(),
            yield TextField::new('twiter')->setLabel('twiter')->hideOnIndex(),

            yield FormField::addTab("Menu latéral"),
            yield TextField::new('horaire_matin')->setLabel('horaire du matin')->hideOnIndex(),
            yield TextField::new('horaire_pm')->setLabel('horaire de l\'après-midi')->hideOnIndex(),
            yield TextField::new('jours_fermes')->setLabel('jours fermés')->hideOnIndex(),
            yield TextField::new('titre1_menu_lat')->setLabel('titre - Espace personnel -')->hideOnIndex(),
            yield TextField::new('titre2_menu_lat')->setLabel('Titre au dessus de - A propos - ')->hideOnIndex(),
            yield TextEditorField::new('texte_menu_lat')->setLabel('passionnée de ...')->hideOnIndex(),
            yield TextField::new('titre3_menu_lat')->setLabel('Invatation à te joindre')->hideOnIndex(),

            //                                                     CAROUSSEL
            yield FormField::addTab("Home caroussel "),

            yield TextField::new('titre1_home')->setLabel('Atout 1')->setColumns(6)-> hideOnIndex(),
            yield AssociationField::new('image1_carouselHome')
                ->setLabel('image n°1 au format 1894x359')
                ->setColumns(4)
                ->setTemplatePath('fields/images.html.twig')->hideOnIndex(),

            yield TextField::new('titre2_home')->setLabel('Atout 2')->setColumns(6)->hideOnIndex(),
            yield AssociationField::new('image2_carouselHome')
                ->setLabel('image n°2 au format 1894x359')
                ->setColumns(4)
                ->setTemplatePath('fields/images.html.twig')->hideOnIndex(),



            yield TextField::new('titre3_home')->setLabel('Atout 3')->setColumns(6)->hideOnIndex(),
            yield AssociationField::new('image3_carouselHome')
                ->setLabel('image n°3 au format 1894x359')
                ->setColumns(4)
                ->setTemplatePath('fields/images.html.twig')->hideOnIndex(),


            //                                                     HEADER

            yield FormField::addTab("Pied de page "),
            yield AssociationField::new('logo')
                ->setLabel('Logo de l\'entreprise au format 72x84')
                ->setColumns(4)
                ->setTemplatePath('fields/images.html.twig')->hideOnIndex(),
            yield TextField::new('titre_header')->setLabel('titre principal pied de page')->setColumns(6)->hideOnIndex(),
            yield TextField::new('titre_header')->setLabel('Titre principal pied de page')->hideOnIndex(),
            yield CollectionField::new('themes_pied_page')->setLabel('Liste des 5 services ')->hideOnIndex(),
            yield TextField::new('titre_pied_page')->setLabel('Accroche')->hideOnIndex(),
            yield FormField::addTab("Couleur de fond "),
            yield TextField::new('couleur_initale_bg')->setLabel('couleur initale des blocks noirs')->hideOnIndex()->setDisabled(),
            yield ColorField::new('couleur_actuelle_bg')->setLabel('couleur désirée'),

        ];
    }
}
