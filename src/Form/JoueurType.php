<?php

namespace App\Form;

use App\Entity\JoueDans;
use App\Entity\Joueur;
use App\Entity\JoueurPoste;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class JoueurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class , array(
                'attr' => ['placeholder' => "Entrer le nom du Club"],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir le club'])
                ],
            ))
            ->add('prenom', TextType::class , array(
                'attr' => ['placeholder' => "Entrer le nom du Club"],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir le club'])
                ],
            ))
            ->add('date_naissance', DateType::class , array(
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir une date de naissance']),
                ],
                'format' => 'dd/MM/yyyy',
                'required' => false,
                'attr' => ['placeholder' => 'jj/mm/aaaa'],
                'html5' => false,
            ))
            ->add('nationalite' , TextType::class , array(
                'attr' => ['placeholder' => "La nationalité"],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir la nationalité'])
                ],
            ))
            ->add('telephone', NumberType::class, array(
                'attr' => ['placeholder' => "Entrer le téléphone du Joueur"],
                'constraints' => [
                    new Assert\Type(['type' => 'numeric', 'message' => 'La valeur saisie n\'est pas un chiffre']),
                    new Assert\Regex([
                        'pattern' => "/^[0-9]{1,}\.{0,1}[0-9]{0,}$/", 'message' => "Seulement un entier positif."
                    ])
                ],
                'required' => false
            ))
            ->add('age', NumberType::class, array(
                'attr' => ['placeholder' => "Entrer l\'age du Joueur"],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir l\'age du Joueur ']),
                    new Assert\Type(['type' => 'numeric', 'message' => 'La valeur saisie n\'est pas un chiffre']),
                    new Assert\Regex([
                        'pattern' => "/^[0-9]{1,}\.{0,1}[0-9]{0,}$/", 'message' => "Seulement un entier positif."
                    ])
                ],
                'required' => false
            ))
            ->add('poids', NumberType::class, array(
                'attr' => ['placeholder' => "Entrer le poids du Joueur"],
                'constraints' => [
                    new Assert\Type(['type' => 'numeric', 'message' => 'La valeur saisie n\'est pas un chiffre']),
                    new Assert\Regex([
                        'pattern' => "/^[0-9]{1,}\.{0,1}[0-9]{0,}$/", 'message' => "Seulement un entier positif."
                    ])
                ],
                'required' => false
            ))
            ->add('taille', NumberType::class, array(
                'attr' => ['placeholder' => "Entrer la taille Du Joueur"],
                'constraints' => [
                    new Assert\Type(['type' => 'numeric', 'message' => 'La valeur saisie n\'est pas un chiffre']),
                    new Assert\Regex([
                        'pattern' => "/^[0-9]{1,}\.{0,1}[0-9]{0,}$/", 'message' => "Seulement un entier positif."
                    ])
                ],
                'required' => false
            ))
            ->add('numero', NumberType::class, array(
                'attr' => ['placeholder' => "Entrer le numero du Joueur"],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir le numero du Joueur']),
                    new Assert\Type(['type' => 'numeric', 'message' => 'La valeur saisie n\'est pas un chiffre']),
                    new Assert\Regex([
                        'pattern' => "/^[0-9]{1,}\.{0,1}[0-9]{0,}$/", 'message' => "Seulement un entier positif."
                    ])
                ],
                'required' => false
            ))
            ->add('pro')
            ->add('photo' , FileType::class , [
                'label' => 'photo',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Joueur::class,
        ]);
    }
}
