<?php

namespace UserBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseForm;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationType extends BaseForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('nom', 'text', array('attr'    => array('class'       => 'form-control',
                                                          'placeholder'    => 'votre nonm')
                                      ))
            ->add('prenom', 'text', array('attr' => array('class'       => 'form-control',
                                                          'placeholder' => 'votre prenonm')
                                      ))
            ->add('numTel', 'text', array('attr' => array('class'       => 'form-control',
                                           'placeholder' => 'votre num tel: XX/XXX.XXX.XXX')
                                          ))
            ->add('numGsm', 'text', array('attr' => array('class'       => 'form-control',
                                           'placeholder' => 'votre num gsm: 04XX/XX.XX.XX')
                                          ))
            ->add('adrRue', 'text', array('attr' => array('class'       => 'form-control',
                                           'placeholder' => 'rue, Num')
                                          ))
            ->add('adrCp', 'text', array('attr' => array('class'       => 'form-control',
                                          'placeholder' => 'Code Postal')
                                          ))
            ->add('adrVille', 'text', array('attr' => array('class'       => 'form-control',
                                            'placeholder' => 'Ville')
                                           ))

            ->add('sexe',ChoiceType::class, array('choices'  => array('homme' => true,
                                                                      'femme' => false),
                                                  'choices_as_values' => true,
                                                  'expanded' => true,
                                                  'multiple' => false))

        ;
    }

    public function getName()
    {
        return 'nala_user_registration';
    }

    /*public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User'
        ));
    }*/
}
