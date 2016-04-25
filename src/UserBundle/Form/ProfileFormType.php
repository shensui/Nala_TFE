<?php
/**
 * Created by PhpStorm.
 * User: Manon
 * Date: 20-04-16
 * Time: 08:08
 */

namespace UserBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseProfil;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ProfileFormType extends BaseProfil
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('nom', 'text', array('attr'    => array('class'       => 'form-control',
                                                          'placeholder' => 'votre nonm',)
            ))
            ->add('prenom', 'text', array('attr' => array('class'       => 'form-control',
                                                          'placeholder' => 'votre prenonm')
            ))
            ->add('numTel', 'text', array('attr' => array('class'       => 'form-control',
                                                          'placeholder' => 'votre num tel: XX/XXX.XXX.XXX',
                                                          ),
                                          'required'    => false,
            ))
            ->add('numGsm', 'text', array('attr' => array('class'       => 'form-control',
                                                          'placeholder' => 'votre num gsm: 04XX/XX.XX.XX',
                                                          ),
                                          'required'    => false,
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
        ;
    }

    public function getBlockPrefix()
    {
        return 'nala_user_profile';
    }
}