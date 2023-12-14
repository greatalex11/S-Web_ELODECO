<?php

namespace App\Controller\Admin;

use App\Entity\Contenus;
use App\Entity\Page;
use App\Repository\PageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\NotSupported;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;


class PageCrudController extends AbstractCrudController
{
//    private EntityManagerInterface $entityManager;
//
//    public function __construct(EntityManagerInterface $entityManager){
//        $this-> entityManager=$entityManager;
//
//    }


    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInPlural('Pages')
            ->setEntityLabelInSingular('Page')
            ->setAutofocusSearch();
    }

//    public function configureActions(Actions $actions): Actions
//    {
//        return parent::configureActions($actions)
//            ->setPermission(Action::NEW, 'ROLE_SUPER_ADMIN')
//            ->setPermission(Action::DELETE, 'ROLE_SUPER_ADMIN');
//    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('nom')->formatValue(function (string $value, Page $page) {
            return "<a href='" . $this->container->get(AdminUrlGenerator::class)
                    ->setController(ContenusCrudController::class)
                    ->set('filters[pages][value][]', $page->getId())
                    ->set('filters[pages][comparison]', '=')
                    ->generateUrl() . "'>{$value}</a>";
        });
        yield TextareaField::new('commentaires');
        yield AssociationField::new('contenus')->hideOnForm();
    }
}
//->setDisabled(!$this->isGranted('ROLE_SUPER_ADMIN'));