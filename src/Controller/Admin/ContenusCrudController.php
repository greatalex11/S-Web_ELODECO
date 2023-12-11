<?php

namespace App\Controller\Admin;


use App\Entity\Contenus;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\TextAlign;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
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

    public function configureActions(Actions $actions): Actions
    {
        $addDetails = Action::new('addDetails', 'créer du détails', 'fa-brands fa-theme-isle')
            ->linkToCrudAction('creatDetails')
            ->addCssClass('btn btn-success')
            ->setIcon('fa fa-check-circle');

        // Je décide de modifier mes acitons de base sur le controller Contenus
        return parent::configureActions($actions)
            // J'enleve le bouton sauver et retourner à la liste dans la page de création
            ->remove(Crud::PAGE_NEW, Action::SAVE_AND_RETURN)
            // J'ajoute le bouton pour remplacer l'autre save and continue qui permet d'aller dans l'édition du contenu
            ->add(Crud::PAGE_NEW, Action::SAVE_AND_CONTINUE)//   ->add(Crud::PAGE_INDEX, $addDetails)
            ;

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

        // Si tu es si tu es pas sur création (edition, show, list)
        if ($pageName !== Action::NEW) {
            yield FormField::addTab("Contenu");
            if ($contenu && $contenu->getType() === Contenus::TYPE_BLOGN) {
                // Slug permet de créer une version url du param sur lequel il est branché, en l'occurance titre 1
                yield SlugField::new('slug')->setTargetFieldName('titre1');
                yield TextField::new('titre1')->setLabel('Titre de la news');
                yield TextEditorField::new('texte1')->setLabel('Contenu de la news')
                    ->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
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
                        'by_reference' => false,])
                    ->setColumns(12)
                    ->setTemplatePath('fields/images.html.twig');

            } elseif ($contenu && $contenu->getType() === Contenus::TYPE_BLOGS) {
                yield TextField::new('titre1')->setLabel('Offre alléchante');
                yield TextField::new('titre2')->setLabel('En bref, argument choc')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
                yield CollectionField::new('images')->useEntryCrudForm(ImageCrudController::class)
                    ->setLabel('image 370x133 - titre important pour référencement')
                    ->setEntryIsComplex(true)
                    ->setFormTypeOptions([
                        'by_reference' => false,])
                    ->setColumns(12)
                    ->setTemplatePath('fields/images.html.twig');

            } elseif ($contenu && $contenu->getType() === Contenus::TYPE_BLOGAC) {
                yield TextField::new('titre1')->setLabel('Mon leitmotiv... ?');
                yield TextField::new('titre2')->setLabel('... la différence ?')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
                yield TextEditorField::new('texte1')->setLabel('atout 1')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
                yield TextEditorField::new('texte2')->setLabel('atout 2')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
//            yield TextField::new('titre3')->setLabel('... ')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
                yield TextEditorField::new('texte3')->setLabel('Ma note perso en quelques mots')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
                yield ArrayField::new('liste')->setLabel('les 5 clefs')->hideOnIndex();
                yield CollectionField::new('images')->useEntryCrudForm(ImageCrudController::class)
                    ->setLabel('image 570x698 - titre important pour référencement')
                    ->setEntryIsComplex(true)
                    ->setFormTypeOptions([
                        'by_reference' => false,])
                    ->setColumns(12)
                    ->setTemplatePath('fields/images.html.twig');

            } elseif ($contenu && $contenu->getType() === Contenus::TYPE_BLOGAE) {
                yield TextField::new('titre1')->setLabel('Métier phare');
                yield TextField::new('titre2')->setLabel('slogan')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
                yield CollectionField::new('images')->useEntryCrudForm(ImageCrudController::class)
                    ->setLabel('image 330X448  - titre important pour référencement')
                    ->setEntryIsComplex(true)
                    ->setFormTypeOptions([
                        'by_reference' => false,])
                    ->setColumns(12)
                    ->setTemplatePath('fields/images.html.twig');

            } elseif ($contenu && $contenu->getType() === Contenus::TYPE_BLOGAL) {
                yield TextField::new('titre1')->setLabel('Métier du moment');
                yield CollectionField::new('images')->useEntryCrudForm(ImageCrudController::class)
                    ->setLabel('image 330X448  - titre important pour référencement')
                    ->setEntryIsComplex(true)
                    ->setFormTypeOptions([
                        'by_reference' => false,])
                    ->setColumns(12)
                    ->setTemplatePath('fields/images.html.twig');

            } elseif ($contenu && $contenu->getType() === Contenus::TYPE_BLOGAT) {

                yield TextEditorField::new('texte1')->setLabel('Témoignage')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
                yield TextField::new('titre1')->setLabel('Nom, Prénom, n°département')->setTemplatePath('fields/raw.html.twig');
                yield TextField::new('titre2')->setLabel('Client/artisan... satisfait')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');


            } elseif ($contenu && $contenu->getType() === Contenus::TYPE_3SERVICESQUALITE) {

                yield TextField::new('titre1')->setLabel('Qualité première');
                yield TextEditorField::new('texte1')->setLabel('Arguments qualité 1ère')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
                yield TextField::new('titre2')->setLabel('ualité secondaire')->hideOnIndex();
                yield TextEditorField::new('texte2')->setLabel('Arguments qualité 2')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
                yield TextField::new('titre3')->setLabel('3ème Qualité')->hideOnIndex();
                yield TextEditorField::new('texte3')->setLabel('Arguments dernière qualité')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');

            } else {
                // Ici les listes
                yield TextField::new('titre1')->setLabel('Titre');
                yield TextEditorField::new('texte1')->setLabel('Contenu')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
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
        }
        yield FormField::addTab("Page");
        yield AssociationField::new('pages')->autocomplete()
            ->setTemplatePath('fields/tags.html.twig')
            ->setTextAlign(TextAlign::LEFT);
        yield ChoiceField::new('type')->setDisabled($pageName === Action::EDIT)
            ->setChoices(Contenus::TYPES);
        yield BooleanField::new('publier')->renderAsSwitch();
        yield DateTimeField::new('updatedAt')->hideOnForm()->setLabel('Dernière modification');
    }

    public function creatDetails(AdminContext $context): Response
    {
        $cul = [1, 2, 33];
        dd($cul);
//        $details = $context->getEntity()->getInstance();
//        $entityManager = $this->container->get('doctrine')->getManagerForClass($className);


        //getId()

        return $this->render('pages/news_details.html.twig', [
            'newDetails' => $details->createView(),
        ]);
    }
}


//  //Essais ajout bouton push
//    public function createBlogDetail(Contenus $contenus) {
//
//        $form = $this->createForm(Contenus::class, $contenus);
//
//        $form->add('button', ButtonType::class, [
//            'label' => 'Ajouter des détails au blog',
//        ]);
////        if ($form->isSubmitted()) {
//            return $this->render('pages/news_details.html.twig', [
//                'form' => $form->createView(),
//            ]);
//        }
