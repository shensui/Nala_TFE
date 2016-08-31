<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DispoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dispoDebut', DateType::class, ['widget' => 'single_text','input'  => 'datetime','format' => 'yyyy-MM-dd'])
            ->add('dispoFin', DateType::class, ['widget' => 'single_text','input'  => 'datetime','format' => 'yyyy-MM-dd'])
            ->add('animal', ChoiceType::class,['choices'  =>['Chat' => 'Chat', 'Chien' => 'Chien', 'Poisson' => 'Poisson']])
            ->add('ajouter', 'submit', array('attr'=> array('class' => 'btn btn-primary')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Dispo'
        ));
    }
}
