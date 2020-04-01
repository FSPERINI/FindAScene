<?php

namespace App\Form;

use App\Entity\Musiciens;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MusiciensType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_grp')
            ->add('mail', EmailType::class)
            ->add('nom_ref')
            ->add('prenom_ref')
            ->add('tel', TelType::class)
            ->add('nb_membres')
            ->add('style')
            ->add('presentation_grp', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Musiciens::class,
        ]);
    }
}
