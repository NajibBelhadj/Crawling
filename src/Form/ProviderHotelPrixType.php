<?php

namespace App\Form;

use App\Entity\ProviderHotelPrix;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProviderHotelPrixType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prix')
            ->add('typeDeChambre')
            ->add('date')
            ->add('providerhotels')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProviderHotelPrix::class,
        ]);
    }
}
