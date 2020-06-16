<?php

namespace App\Form;

use App\Form\ImageType;
use App\Entity\GrandPrix;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class GrandPrixPhotoEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
     
            ->add('map', FileType::class, [
                'label' => 'Carte du circuit',
                'attr' => [
                    'placeholder'=>"ajoutez la photo de la carte du circuit"
                ]
            ])
            ->add('cover', FileType::class, [
                'label' => 'Photo de couverture',
                'attr' => [
                    'placeholder'=>"ajoutez la photo de couverture du circuit"
                ]
             
            ])

            
           
             ;

           
           
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
          
        ]);
    }
}
