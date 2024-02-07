<?php

namespace App\Service;



use App\Entity\ContactForm;
use App\Repository\ContactFormRepository;
use mysql_xdevapi\TableUpdate;

class gestionMsg
{

    private ?ContactFormRepository $contactForm;


    public function __construct(ContactForm $contactForm, ContactFormRepository $contactFormRepository)
    {
        $table=$this->$contactForm()->update('ContactForm', 'c')
        ->set('c.msgLu', '0')
        ->where('c.status = :status')
        ->setParameter('status', 'traitement en cours')
        ->getQuery()
        ->getResult();


        return $this;
    }
}

