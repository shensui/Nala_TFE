<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class AnimalsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('type', ChoiceType::class,['choices'  =>['Chat' => 'Chat', 'Chien' => 'Chien', 'Poisson' => 'Poisson']])
            ->add('sexe', ChoiceType::class,['choices'  =>['0' => 'Femelle', '1' => 'Male'], 'expanded'=>false, 'multiple'=> false])
            ->add('age','text')
            ->add('santee', 'textarea')
            ->add('ajouter', 'submit', array('attr' => array('class' => 'btn btn-primary')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Animals'
        ));
    }
}
