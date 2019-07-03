<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EquipoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categoria')
            ->add('sexo', ChoiceType::class, [
                'choices'  => [
                    'Mixto' => true,
                    'Masculino' => false,
                    'Femenino' => false
                ]])
            ->add('numjugadores')
            ->add('save', SubmitType::class, ['label' => $options['saveText']])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(array(
            'saveText'
        ));
    }
}