<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Artist;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => "Titre de l'album",
            ])
            ->add('releaseDate', null, [
                'label' => "Date de sortie",
            ])
            ->add('picture', FileType::class, [
                'label' => "Jaquette de l'album",
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Assert\File(
                        maxSize: '1024k',
                        extensions: ['jpg', 'jpeg', 'png'],
                        extensionsMessage: 'Télécharger une image au format .jpg, .jpeg ou .png',
                    )
                ],
            ] )
            ->add('type', null, [
                'label' => "Type de CD",
            ])
            ->add('artist', EntityType::class, [
                'class' => Artist::class,
                'choice_label' => 'stageName',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}
