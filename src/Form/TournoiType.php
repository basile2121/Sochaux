<?php

namespace App\Form;

use App\Entity\Tournoi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;

class TournoiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_tournoi', TextType::class , array(
                'attr' => ['placeholder' => "Entrer le nom du Tournoi"],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir le tournoi'])
                ],
            ))
            ->add('pays_tournoi', TextType::class , array(
                'attr' => ['placeholder' => "Entrer le Pays du Tournoi"],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir le pays'])
                ],
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tournoi::class,
        ]);
    }
}
