<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Contrat;
use App\Entity\Joueur;
use App\Entity\Tactique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;

class ContratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('joueur',EntityType::class, array(
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Choisir le Joueur']),
                ],
                'required' => false,
                'class' => Joueur::class,
                'placeholder' => 'Chosir le Joueur',
                'attr' => ['placeholder' => "Chosir le Joueur"]
            ))
            ->add('club',EntityType::class, array(
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Choisir le Club']),
                ],
                'required' => false,
                'class' => Club::class,
                'placeholder' => 'Choisir le Club',
                'attr' => ['placeholder' => "Choisir le Club"]
            ))
            ->add('prix' , NumberType::class, array(
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir un prix']),
                    new Assert\Type(['type' => 'numeric', 'message' => 'La valeur saisie n\'est pas un chiffre']),
                ],
                'required' => false
            ))
            ->add('date_debut', DateType::class , array(
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir une date de Debut']),
                    new Assert\Type(['type' => 'date', 'message' => 'La valeur saisie n\'est pas une date']),
                ],
                'format' => 'dd/MM/yyyy',
                'required' => false,
                'attr' => ['placeholder' => 'jj/mm/aaaa'],
                'html5' => false,
            ))
            ->add('date_fin', DateType::class , array(
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir une date de Fin']),
                    new Assert\Type(['type' => 'date', 'message' => 'La valeur saisie n\'est pas une date']),
                ],
                'format' => 'dd/MM/yyyy',
                'required' => false,
                'attr' => ['placeholder' => 'jj/mm/aaaa'],
                'html5' => false,
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contrat::class,
        ]);
    }
}
