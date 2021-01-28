<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\RapportSpecifique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatchsSearchType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateMatch' , TextType::class , [
                'label' => 'Rechercher avec une date (YYYY-MM-DD)',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Entrer une date '
                ]

                ])
            ->add('equipe1' ,TextType::class , [
                'label' => 'Rechercher avec une première équipe',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Entrer une équipe '
                ]
            ])
            ->add('equipe2' ,TextType::class , [
                'label' => 'Rechercher avec une deuxième équipe',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Entrer une équipe '
                ]
            ])
            ->add('lieux' ,TextType::class , [
                'label' => 'Rechercher avec un lieu',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Entrer un lieu'
                ]
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false,
            "allow_extra_fields" => true
            ]);


    }

    public function getBlockPrefix()
    {
       return '';
    }
}