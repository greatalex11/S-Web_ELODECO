<?php

namespace App\Form;

use App\Entity\Artisan;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtisanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('raison_sociale')
            ->add('nom_etablissement')
            ->add('siret')
            ->add('nom_gerant')
            ->add('prenom_gerant')
            //->add('date_naissance')
            ->add('date_naissance', BirthdayType::class, [
                'placeholder' => 'Sélectionnez une valeur',
                'years' => range(date('Y') - 90, date('Y')),
                ])
            ->add('numero_rue')
            ->add('nom_rue')
            ->add('code_postal')
            ->add('localite')
            ->add('email')
            ->add('tel_fixe')
            ->add('tel_portable')
            ->add('fax')
            ->add('submit', SubmitType::class);
//            ->add('note_globale')
//            ->add('commentaire')
//            ->add('status')
//            ->add('user')

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artisan::class,
        ]);
    }
}
