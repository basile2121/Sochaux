<?php

namespace App\Form;

use App\Entity\Contrat;
use App\Entity\Matchs;

use App\Entity\Tournoi;
use App\Repository\TournoiRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Validator\Constraints as Assert;

class MatchTypeTournoi extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
                $pays = $event->getData();
                $pays->getPaysMatch();
                $event->getForm()->add('tournoi', EntityType::class, array(
                    'constraints' => [
                        new Assert\NotBlank(['message' => 'Choisir le Tournoi du match']),
                    ],
                    'class' => Tournoi::class,
                    'choice_label' => 'nom_tournoi',
                    'placeholder' => 'Chosir un Tournoi',
                    'attr' => ['placeholder' => "Le Tournoi"],
                    'query_builder' => function(TournoiRepository $repository) use($pays){
                        return $repository->getPaysTournoi($pays->getPaysMatch());
                    }
                ));
            });
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Matchs::class,
        ]);


    }
}
