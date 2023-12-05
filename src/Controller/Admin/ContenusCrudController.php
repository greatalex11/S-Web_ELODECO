<?php

namespace App\Controller\Admin;


use App\Entity\Contenus;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\TextAlign;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContenusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contenus::class;

    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('pages');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInPlural('Contenus')
            ->setEntityLabelInSingular('Contenu')
            ->setAutofocusSearch()
            ->setDefaultSort(['updatedAt' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        /** @var Contenus $contenu */
        $contenu = $this->getContext()?->getEntity()->getInstance();


        yield FormField::addTab("Page");
        yield AssociationField::new('pages')->autocomplete()
            ->setTemplatePath('fields/tags.html.twig')
            ->setTextAlign(TextAlign::LEFT);
        yield ChoiceField::new('type')
            ->setChoices(Contenus::TYPES);
        yield FormField::addTab("Contenu");


        if ($contenu && $contenu->getType() === Contenus::TYPE_BLOGN) {
            yield TextField::new('titre1')->setLabel('Titre du blog');
            yield TextEditorField::new('texte1')->setLabel('Contenu du blog')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
            yield TextField::new('titre2')->setLabel('Date')->hideOnIndex();
            yield CollectionField::new('images')->useEntryCrudForm(ImageCrudController::class)
                ->setEntryIsComplex(true)
                ->setFormTypeOptions([
                    'by_reference' => false,
                ])
                ->setColumns(12)
                ->setTemplatePath('fields/images.html.twig');

        } elseif ($contenu && $contenu->getType() === Contenus::TYPE_3SERVICES) {
            yield TextField::new('titre1')->setLabel('Service 1');
            yield TextEditorField::new('texte1')->setLabel('Contenu')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
            yield TextField::new('titre2')->setLabel('Service 2')->hideOnIndex();
            yield TextEditorField::new('texte2')->setLabel('Contenu')->hideOnIndex();
            yield TextField::new('titre3')->setLabel('Service 3')->hideOnIndex();
            yield TextEditorField::new('texte3')->setLabel('Contenu')->hideOnIndex();


        } elseif ($contenu && $contenu->getType() === Contenus::TYPE_3SERVICESPRO) {
            yield TextField::new('titre1')->setLabel('Premier service');
            yield TextEditorField::new('texte1')->setLabel('argument 1')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
            yield TextField::new('titre2')->setLabel('Second service')->hideOnIndex();
            yield TextEditorField::new('texte2')->setLabel('argument 2')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
            yield TextField::new('titre3')->setLabel(' 3ème service pro')->hideOnIndex();
            yield TextEditorField::new('texte3')->setLabel('argument 3')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');

        } elseif ($contenu && $contenu->getType() === Contenus::TYPE_1SERVICEPRO) {
            yield TextField::new('titre1')->setLabel('Ce que tu fais... ?');
            yield TextField::new('titre2')->setLabel('... de meilleur ?')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
            yield TextEditorField::new('texte2')->setLabel('en quelques mots')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
            yield CollectionField::new('images')->useEntryCrudForm(ImageCrudController::class)
                ->setLabel('image 672x713 - titre important pour référencement')
                ->setEntryIsComplex(true)
                ->setFormTypeOptions([
                    'by_reference' => false,  ])
                ->setColumns(12)
                ->setTemplatePath('fields/images.html.twig');

        } elseif ($contenu && $contenu->getType() === Contenus::TYPE_BLOGS) {
            yield TextField::new('titre1')->setLabel('Offre alléchante');
            yield TextField::new('titre2')->setLabel('En bref, argument choc')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
            yield CollectionField::new('images')->useEntryCrudForm(ImageCrudController::class)
                ->setLabel('image 370x133 - titre important pour référencement')
                ->setEntryIsComplex(true)
                ->setFormTypeOptions([
                    'by_reference' => false,  ])
                ->setColumns(12)
                ->setTemplatePath('fields/images.html.twig');


        } elseif ($contenu && $contenu->getType() === Contenus::TYPE_3SERVICESQUALITE) {

            yield TextField::new('titre1')->setLabel('Qualité première');
            yield TextEditorField::new('texte1')->setLabel('Arguments qualité 1ère')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
            yield TextField::new('titre2')->setLabel('ualité secondaire')->hideOnIndex();
            yield TextEditorField::new('texte2')->setLabel('Arguments qualité 2')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
            yield TextField::new('titre3')->setLabel('3ème Qualité')->hideOnIndex();
            yield TextEditorField::new('texte3')->setLabel('Arguments dernière qualité')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');

        } else {
            yield TextField::new('titre1')->setLabel('Titre 1');
            yield TextEditorField::new('texte1')->setLabel('Contenu 1')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
            yield TextField::new('titre2')->setLabel('Titre 2')->hideOnIndex();
            yield TextEditorField::new('texte2')->setLabel('Contenu 2')->hideOnIndex();
            yield TextField::new('titre3')->setLabel('Titre 3')->hideOnIndex();
            yield TextEditorField::new('texte3')->setLabel('Contenu 3')->hideOnIndex();
            yield CollectionField::new('liste')->hideOnIndex();
            yield CollectionField::new('images')->useEntryCrudForm(ImageCrudController::class)
                ->setEntryIsComplex(true)
                ->setFormTypeOptions([
                    'by_reference' => false,
                ])
                ->setColumns(12)
                ->setTemplatePath('fields/images.html.twig');
        }
        yield BooleanField::new('publier')->renderAsSwitch();
        yield DateTimeField::new('updatedAt')->hideOnForm()->setLabel('Dernière modification');
    }

}
