<?php

namespace App\Form;

use App\Entity\Musiciens;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MusiciensType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Mot De passe'),
                'second_options' => array ('label' => 'Confirmation du mot de passe'),
            ))
            ->add('mail', EmailType::class)
            ->add('groupe')
            ->add('city')
            ->add('description', TextareaType::class)
            ->add('picture')
            ;           
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Musiciens::class,
            'translation_domain' => 'forms'
        ]);
    }
}
