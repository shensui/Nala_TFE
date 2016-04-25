<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('dispoDebut', TextType::class, ['attr' => ['class' => 'form-control datepikerD']])
            ->add('dispoFin', TextType::class, ['attr' => ['class' => 'form-control datepikerF']])
            ->add('animal', TextType::class, ['attr' => ['class' => 'form-control']])
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
