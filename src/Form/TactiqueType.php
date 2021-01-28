<?php

namespace App\Form;

use App\Entity\Participe;
use App\Entity\Tactique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Validator\Constraints as Assert;

class TactiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tactique_first_club',EntityType::class, array(
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Choisir la tactique de la premiere équipe']),
                ],
                'required' => false,
                'class' => Tactique::class,
                'placeholder' => 'Chosir le Premiere Tactique',
                'attr' => ['placeholder' => "Chosir le première tactique"]
            ))
            ->add('tactique_second_club',EntityType::class, array(
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Choisir la tactique de la deuxieme équipe']),
                ],
                'required' => false,
                'class' => Tactique::class,
                'placeholder' => 'Chosir la Deuxieme Tactique ',
                'attr' => ['placeholder' => "Chosir le deuxieme tactique"]
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participe::class,
        ]);
    }
}
