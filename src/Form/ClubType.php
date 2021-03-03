<?php

namespace App\Form;

use App\Entity\Club;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;

class ClubType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_club', TextType::class , array(
                'attr' => ['placeholder' => "Entrer le nom du Club"],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir le club'])
                ],
            ))
            ->add('ville_club', TextType::class , array(
                'attr' => ['placeholder' => "Entrer la ville du Match"],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir la ville du Match'])
                ],
            ))
            ->add('pays_club', TextType::class , array(
                'attr' => ['placeholder' => "Entrer le Pays du Club"],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir le Pays '])
                ],
            ))

            //->add('championnat')
            //->add('participes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Club::class,
        ]);
    }
}
