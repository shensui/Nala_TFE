<?php
/**
 * Created by PhpStorm.
 * User: Manon
 * Date: 04-04-16
 * Time: 10:30
 */

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class DispoSearchType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $listAnimal = ["chien"   => 'chien',
                       "chat"    => "chat",
                       "lezard"  => "lezard",
                       "poisson" => "poison",
                       "etc"     => "etc"];
        $builder
              ->add('type',ChoiceType::class, array('choices'  => $listAnimal,
                                                    'expanded' => false,
                                                    'multiple' =>false,
                                                    'attr' => array('class' => 'form-control input-lg')))
              ->add('ville', EntityType::class, array('class' => 'UserBundle:User',
                                                    'property' => 'adrVille',
                                                    'query_builder' => function (EntityRepository $er){
                                                                                    return $er->createQueryBuilder('u')
                                                                                              ->groupBy('u.adrVille')
                                                                                              ->orderBy('u.adrVille', 'ASC');

                                                                                },
                                                    'expanded' => false,
                                                    'multiple' =>false,
                                                    'attr'     => array('class'    => 'form-control input-lg'),
            ))
            ->add('min_date',  DateType::class, array('widget' => 'single_text','html5' => false,'attr'=> array('placeholder'=>'Disponible du','class'=> 'input-lg datepikerD')))
            ->add('max_date',  DateType::class, array('widget' => 'single_text','html5' => false,'attr'=> array('placeholder'=>'aux','class'=> 'datepikerF input-lg')))
            ->add('trouver', 'submit', array('attr' => array('class' => 'btn btn-validate')))
        ;
    }

    public function getName()
    {
        return 'UserBundle_Dispo_Search';
    }
}