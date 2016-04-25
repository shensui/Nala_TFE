<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('message','textarea', array('attr' => array('class' => 'form-control', 'cols' => '30', 'rows'  => '10')))
            //->add('auteur','text', array('attr' => array('class' => 'form-control', 'placeholder' => 'Username')))
            ->add('envoyer', 'submit', array('attr' => array('class' => 'btn btn-validate')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Message'
        ));
    }
}
