<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Participe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Validator\Constraints as Assert;

class ParticipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('club_first',EntityType::class, array(
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Choisir la première équipe']),
                ],
                'required' => false,
                'class' => Club::class,
                'placeholder' => 'Chosir le Premiere Equipe',
                'attr' => ['placeholder' => "Chosir le première équipe"]
            ))

            ->add('club_second',EntityType::class, array(
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Choisir la deuxième équipe']),
                ],
                'required' => false,
                'class' => Club::class,
                'placeholder' => 'Chosir la deuxième équipe',
                'attr' => ['placeholder' => "Chosir la deuxième équipe"]
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participe::class,
        ]);
    }
}
