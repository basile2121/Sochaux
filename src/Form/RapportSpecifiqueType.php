<?php

namespace App\Form;

use App\Entity\RapportSpecifique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportSpecifiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('qualite_technique')
            ->add('qualite_mentale')
            ->add('qualite_physique')
            ->add('qualite_tactique')
            ->add('nom_agent')
            ->add('joueur')
           /* ->add('commentes')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RapportSpecifique::class,
        ]);
    }
}
