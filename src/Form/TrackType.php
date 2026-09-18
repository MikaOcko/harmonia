<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Playlist;
use App\Entity\Style;
use App\Entity\Track;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => "Titre de la chanson",
            ])
            ->add('duration', null, [
                'label' => 'Durée (en secondes)',
            ])
            ->add('number', null, [
                'label' => "Piste n°",
            ])
            ->add('isExplicitContent', null, [
                'label' => "Contenu explicite ?"
            ])
            ->add('styles', EntityType::class, [
                'class' => Style::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Track::class,
        ]);
    }
}
