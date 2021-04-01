<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Joueur;
use App\Entity\RapportSpecifique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RapportSpecifiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_agent', TextType::class , array(
                'attr' => ['placeholder' => "Entrer un Nom"],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir le nom de L\'agent'])
                ],
            ))
            ->add('adresseAgent', TextType::class , array(
                'attr' => ['placeholder' => "Entrer Une Adresse"],
            ))
            ->add('telephoneAgent', NumberType::class, array(
                'attr' => ['placeholder' => "Entrer le Numero de Tel"],
                'constraints' => [
                    new Assert\Type(['type' => 'numeric', 'message' => 'La valeur saisie n\'est pas un chiffre']),
                    new Assert\Regex([
                        'pattern' => "/^[0-9]{1,}\.{0,1}[0-9]{0,}$/", 'message' => "Seulement un entier positif."
                    ])
                ],
                'required' => false
            ))
            ->add('mailAgent', TextType::class , array(
                'attr' => ['placeholder' => "Entrer le Mail"],
            ))

            ->add('equipe1',EntityType::class, array(
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Choisir une équipe']),
                ],
                'class' => Club::class,
                'placeholder' => 'Chosir Equipe 1 ',
            ))
            ->add('equipe2',EntityType::class, array(
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Choisir une équipe']),
                ],
                'class' => Club::class,
                'placeholder' => 'Chosir Equipe 2',
            ))

            ->add('joueur',EntityType::class, array(
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Choisir un Joueur']),
                ],
                'class' => Joueur::class,
                'placeholder' => 'Chosir un Joueur',
            ))
            ->add('noteJoueur', NumberType::class, array(
                'attr' => ['placeholder' => "Entrer la note"],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir la note']),
                    new Assert\Type(['type' => 'numeric', 'message' => 'La valeur saisie n\'est pas un chiffre']),
                    new Assert\Regex([
                        'pattern' => "/^[0-9]{1,}\.{0,1}[0-9]{0,}$/", 'message' => "Seulement un entier positif."
                    ])
                ],
                'required' => false
            ))
            ->add('qualite_technique', TextType::class , array(
                'attr' => ['placeholder' => "Entrer la qualité Technique"],
            ))
            ->add('qualite_mentale', TextType::class , array(
                'attr' => ['placeholder' => "Entrer la qualité Mentale"],
            ))
            ->add('qualite_physique', TextType::class , array(
                'attr' => ['placeholder' => "Entrer la qualité Physique"],
            ))
            ->add('qualite_tactique', TextType::class , array(
                'attr' => ['placeholder' => "Entrer la qualité Tactique"],
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RapportSpecifique::class,
        ]);
    }
}
