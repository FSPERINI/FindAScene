<?php

namespace App\Form;

use App\Entity\Salles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SallesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('nom_salle', null, ['label' => "Nom de la salle"], ['attr' => ['class' => 'label_salle']])
            ->add('nom_ref', null, ['label' => "Nom du référent"], ['attr' => ['class' => 'referent']])
            ->add('ville', null, ['label' => "Ville"], ['attr' => ['class' => 'ville']])
            ->add('adresse', null, ['label' => "Adresse"], ['attr' => ['class' => 'label_salle']])
            ->add('mail', EmailType::class, ['label' => "E-mail"], ['attr' => ['class' => 'email']])
            ->add('tel', TelType::class, ['label' => "N° de téléphone"], ['attr' => ['class' => 'telephone']])
            ->add('capacite', null, ['label' => "Capacité d'accueil"], ['attr' => ['class' => 'capacite']])
            ->add('categorie', null, ['label' => "Catégorie"], ['attr' => ['class' => 'categorie']])
            ->add('backline', null, ['label' => "Backline"], ['attr' => ['class' => 'backline']])
            ->add('description', null, ['label' => "Description des lieux"], ['attr' => ['class' => 'description_lieu']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Salles::class,
            'translation_domain' => 'forms'
        ]);
    }


}

