<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInPlural('Users')
            ->setEntityLabelInSingular('User')
            ->setAutofocusSearch()
            ->setDefaultSort(['updatedAt' => 'DESC']);
    }


    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')->hideOnForm();
        yield EmailField::new('email');
        yield ChoiceField::new('roles')->allowMultipleChoices()->setChoices(User::ROLES);
        yield BooleanField::new("isVerified");
        yield TextField::new("password");

    }

}
