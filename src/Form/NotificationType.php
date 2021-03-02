<?php

namespace App\Form;

use App\Entity\Notification;
use App\Entity\RapportSpecifique;
use App\Entity\Tactique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;

class NotificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateEnvoie' , DateType::class , array(
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir une date']),
                ],
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'required' => false,
                'attr' => ['placeholder' => 'jj/mm/aaaa'],
                'html5' => false,
            ))
            ->add('messageNotification' , TextType::class , array(
                'attr' => ['placeholder' => "Entrer le Message "],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir le message'])
                ],
            ))
            ->add('rapportSpecifique',EntityType::class, array(
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Choisir un rapport Specique associé']),
                ],
                'required' => false,
                'class' => RapportSpecifique::class,
                'placeholder' => 'Chosir le rapport',
                'attr' => ['placeholder' => "Chosir le rapport"]
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Notification::class,
        ]);
    }
}
