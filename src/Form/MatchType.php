<?php

namespace App\Form;

use App\Entity\Contrat;
use App\Entity\Matchs;

use App\Entity\Tournoi;
use App\Repository\TournoiRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Validator\Constraints as Assert;

class MatchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('paysMatch' , TextType::class , array(
                'attr' => ['placeholder' => "Entrer le pays ou le continent du match"],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir le pays ou le continent du match'])
                ],
            ))
            ->add('lieux' , TextType::class , array(
                'attr' => ['placeholder' => "Entrer la ville du match"],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir la ville du match'])
                ],
            ))
            ->add('conditions' , TextType::class , array(
                'attr' => ['placeholder' => "La condition "],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir une condition'])
                ],
            ))
            ->add('date' , DateType::class , array(
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir une date']),
                ],
                'widget' => 'single_text',
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
            'data_class' => Matchs::class,
        ]);
    }
}
