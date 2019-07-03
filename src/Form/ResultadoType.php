<?php

namespace App\Form;

use App\Entity\Resultado;
use App\Entity\Equipo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ResultadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('puntoslocal',NumberType::class,
            ['label'=>'Puntos Local']
            )
            ->add('puntosvisitante',NumberType::class,
            ['label'=>'Puntos Visitante'])
            ->add('fechapartido', DateType::class, 
            [
                // renders it as a single text box
                'widget' => 'single_text',
                'label'=>'Fecha partido'
            ])
            ->add('cancha')
            ->add('equipolocal',EntityType::class,
            [
                'class' => Equipo::class,
                'label'=>'Equipo local'
            ])
            ->add('equipovisitante')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Resultado::class,
        ]);
    }
}
