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
            ->add('name', null, ['label' => "Nom d'utilisateur"], ['attr' => ['class' => 'username']])
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Mot De passe',),
                'second_options' => array ('label' => 'Confirmation du mot de passe'),
            ))
            ->add('mail', EmailType::class,  ['label' => "E-mail"], ['attr' => ['class' => 'email']])
            ->add('groupe', null, ['label' => "Nom du groupe"], ['attr' => ['class' => 'username']])
            ->add('city',  null, ['label' => "Ville"], ['attr' => ['class' => 'ville']])
            ->add('description', TextareaType::class, ['label' => "Description"], ['attr' => ['class' => 'description_groupe']])
            ->add('picture', null, ['label' => "Illustration"], ['attr' => ['class' => 'illustration']])
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
