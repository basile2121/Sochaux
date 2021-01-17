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

class JoueursSearchType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('searchBarre' , TextType::class , [
                'label' => 'Rechercher un Joueur',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Entrer le nom du Joueur '
                ]

                ])
            ->add('pro' , CheckboxType::class , [
                'label' => 'Joueur Pro',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Joueur Pro'
                ]
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
            ]);


    }

    public function getBlockPrefix()
    {
       return '';
    }
}