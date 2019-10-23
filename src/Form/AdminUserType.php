<?php

namespace App\Form;

use App\Entity\Ad;
use App\Entity\Role;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class,  [
                'label'=>" Prénom",
                'attr' =>[
                    'placeholder'=>" Modifier le prénom "
                ]
            ])
            ->add('lastName', TextType::class, [
                'label'=>" Nom",
                'attr' =>[
                    'placeholder'=>" Modifier le nom "
                ]
            ])
            ->add('email', EmailType::class,  [
                'label'=>" Email",
                'attr' =>[
                    'placeholder'=>" Modifier l'email "
                ]
            ])
            ->add('introduction',TextareaType::class,  [
                'label'=>" Introdution",
                'attr' =>[
                    'placeholder'=>" Modifier l'introduction "
                ]
            ])
            ->add('description', TextareaType::class,  [
                'label'=>"Description",
                'attr' =>[
                    'placeholder'=>" Modifier la description "
                ]
            ])
            ->add('userRoles', null )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
