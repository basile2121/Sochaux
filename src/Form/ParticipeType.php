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
                    new Assert\NotBlank(['message' => 'Choisir la premiere equipe']),
                ],
                'required' => false,
                'class' => Club::class,
                'placeholder' => 'Chosir le Premiere Equipe',
                'attr' => ['placeholder' => "Chosir le Premiere Equipe"]
            ))

            ->add('club_second',EntityType::class, array(
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Choisir la deuxieme equipe']),
                ],
                'required' => false,
                'class' => Club::class,
                'placeholder' => 'Chosir la Deuxieme Equipe',
                'attr' => ['placeholder' => "Chosir la Deuxieme Equipe"]
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
