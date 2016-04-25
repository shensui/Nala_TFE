<?php

namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContacteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('auteur', 'text', array('attr' => array('class' => 'form-control',
                                                          'placeholder' => 'votre nonm')))
            ->add('mail', 'email', array('attr' => array('class' => 'form-control',
                                                         'placeholder' => 'nom@domaine.xx')))
            ->add('message', 'textarea', array('attr' => array('rows' => '10',
                                                               'placeholder' => 'votre message')))
            ->add('envoyer', 'submit', array('attr' => array('class' => 'btn btn-primary')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CoreBundle\Entity\Contacte'
        ));
    }
}
