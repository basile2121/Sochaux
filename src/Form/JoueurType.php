<?php

namespace App\Form;

use App\Entity\JoueDans;
use App\Entity\Joueur;
use App\Entity\JoueurPoste;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class JoueurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('poids')
            ->add('taille')
            ->add('age')
            ->add('pro')
            ->add('titulaire_nombre')
            ->add('nb_passe_decissive')
            ->add('nb_carton_rouge')
            ->add('nb_carton_jaune')
            ->add('date_naissance')
            ->add('telephone')
            ->add('numero')
            ->add('photo' , FileType::class , [
                'label' => 'photo',
            ])
            ->add('nb_but')

            ->add('nationalite')


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Joueur::class,
        ]);
    }
}
