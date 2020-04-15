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
            ->add('nom_ref')
            ->add('ville')
            ->add('adresse')
            ->add('mail', EmailType::class)
            ->add('tel', TelType::class)
            ->add('capacite')
            ->add('categorie')
            ->add('backline')
            ->add('description')
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

