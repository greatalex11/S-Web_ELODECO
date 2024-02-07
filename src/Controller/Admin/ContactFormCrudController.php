<?php

namespace App\Controller\Admin;

use App\Entity\ContactForm;
use App\Service\countMsg;
use App\Service\gestionMsg;
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

//  Essai avec fonction
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

    public function __construct(gestionMsg $gmsg)
    {
        $this->gmsg = $gmsg;
    }

    public function configureFields(string $pageName): iterable
    {
//        //  Essai avec context
//        $entity=$this->getContext()->getEntity()->getInstance();
//
//        /** @var ContactForm $contactForm */
//        $contactForm=$entity;
//        $boolMsg = $contactForm->isMsgLu();
//        $status = $contactForm->getStatus();
//
//        if ($status === "") {
//            $contactForm->setMsgLu("0");
//        }else{
//            $contactForm->setMsgLu("$boolMsg");
//        }
//        $bool=$contactForm->isMsgLu();


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
//                ->setValue($this->gmsg)
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

