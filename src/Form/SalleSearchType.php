<?php

namespace App\Form;

use App\Entity\SalleSearch;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalleSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', StringType::class, [
                'required' => false,
                'label' => false,
                'attr' =>[
                    'placeholer' => 'Ville'
                ]
            ])
            ->add('name', StringType::class, [
                'required' => false,
                'label' => false,
                'attr' =>[
                    'placeholer' => 'Nom de salle'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SalleSearch::class,
            'method' => 'get',
            'csrf_protection' => false,

        ]);
    }
}
