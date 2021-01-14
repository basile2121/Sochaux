<?php

namespace App\Form;

use App\Entity\Commentaire;
use App\Entity\Contrat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('texte' , TextType::class , array(
                'attr' => ['placeholder' => "Entrer le commentaire du match"],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir le commentaire'])
                ],
            ))
            ->add('minute_commentaire' , TextType::class , array(
                'attr' => ['placeholder' => "Minutes des commentaires"],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Saisir la minutes du commentaire'])
                ],
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
