<?php

namespace App\Form;

use App\Entity\Contrat;
use App\Entity\Matchs;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;

class MatchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lieux')
            ->add('conditions')
            ->add('date' , DateType::class , array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'required' => false,
                'attr' => ['placeholder' => 'jj/mm/aaaa'],
                'html5' => false,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir une date'])
                ]
            ))
            ->add('tournoi')
            ->add('club')


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Matchs::class,
        ]);
    }
}
