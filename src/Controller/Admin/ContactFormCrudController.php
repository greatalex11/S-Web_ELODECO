<?php

namespace App\Controller\Admin;

use App\Entity\ContactForm;
use App\Repository\ContactFormRepository;
use App\Service\countMsg;
use App\Service\gestionMsg;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use phpDocumentor\Reflection\Types\Boolean;

class ContactFormCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
       return ContactForm::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('nom')
            ->add('sujet');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInPlural('Contacts')
            ->setEntityLabelInSingular('Contacts')
            ->setAutofocusSearch();
//            ->setDefaultSort(['updatedAt' => 'DESC']);
    }

//  ******* Essai avec fonction ******
//    public function dynTraitMsg():Boolean
//    {   $ContactForm = ContactForm::class;
//        $status = $ContactForm->$ContactForm->getStatus();
//        $boolMsg = $ContactForm->$ContactForm->isMsgLu();
//
//        if ($status === "") {
//            $ContactForm->$ContactForm->setMsgLu("0");
//        }else{
//            $ContactForm->$ContactForm->setMsgLu("$boolMsg");
//        }
//        $bool=$ContactForm->$ContactForm->isMsgLu();
//        return $bool;
//    }
//    private bool $bool;

//    public function __construct(Boolean $bool)
//    {
//        $this->dynTraitMsg($bool);
//    }

//  ******* Essai avec le service  ******
//    public function __construct(gestionMsg $list)
//    {
//        $this->list = $list;
//    }

//  ******* Essai avec entity ******
//        /** @var ContactForm $contactForm */
//        $contactForm=$entity;
//        $boolMsg=null ;
//        $status = null;//
//        if ($contactForm->getStatus() != "à traiter") {
//            $contactForm->setMsgLu("0");//
//        }else{
//            $contactForm->setMsgLu("$boolMsg");
//        }
//        $bool=$contactForm->isMsgLu();

//        //  Essai avec SQL
//        $entity=$this->getContext()->getEntity()->getInstance();//
//        $entity->update('ContactForm', 'c')
//            ->set('c.msgLu', '0')
//            ->where('c.status = :status')
//            ->setParameter('status', 'traitement en cours')
//            ->getQuery()
//            ->getResult();

    public function configureFields(string $pageName): iterable
    {

        return [
            yield FormField::addTab("listing"),
//            yield IdField::new('id'),
            yield TextField::new('nom'),
            yield TextField::new('sujet'),
            yield DateField::new('date_creation'),
            yield ChoiceField::new('status')
                ->setChoices(ContactForm::statusMsg)
                ->setLabel('statut'),

            yield BooleanField::new('msgLu')->renderAsSwitch()
                ->setLabel('Pas encore lu')
//              ->setValue($this->list)
//              ->setValue($this->$bool)
                ->setTemplatePath('fields/bouton.html.twig'),

            yield FormField::addTab("Message")->hideOnIndex(),
            yield TextEditorField::new('message')->hideOnIndex(),

            yield FormField::addTab("Coordonnées")->hideOnIndex(),
            yield TextField::new('prenom')->hideOnIndex(),
            yield TextField::new('nom')->hideOnIndex(),
            yield TextField::new('telephone')
                ->hideOnIndex(),
            yield TextField::new('email')
                ->hideOnIndex(),
        ];
    }
}

