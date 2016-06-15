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
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DispoSearchType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('type',  EntityType::class, array('class' => 'UserBundle:Dispo',
                                                    'property' => 'animal',
                                                    'query_builder' => function (EntityRepository $er){
                                                                            return $er->createQueryBuilder('a')
                                                                                ->groupBy('a.animal')
                                                                                ->orderBy('a.animal', 'ASC');

                                                    },
                                                    'expanded' => false,
                                                    'multiple' =>false,
                                                    'attr'     => array('class'    => 'form-control input-lg'),
            ))
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
            ->add('min_date',  DateType::class,['widget' => 'single_text','input'  => 'datetime','format' => 'yyyy-MM-dd'])
            ->add('max_date',  DateType::class,['widget' => 'single_text','input'  => 'datetime','format' => 'yyyy-MM-dd'])
            ->add('trouver', 'submit', array('attr' => array('class' => 'btn btn-validate')))
        ;
    }

    public function getName()
    {
        return 'UserBundle_Dispo_Search';
    }
}