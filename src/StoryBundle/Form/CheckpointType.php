<?php

namespace StoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CheckpointType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class, array(
                'attr' => array(
                    'class' => 'content',
                    'rows' => '5',
                    'placeholder' => 'Write a little story'
                )))
            ->add('number', NumberType::class, array(
                'attr' => array('placeholder' => 'number')
            ))
            ->add('title', TextType::class, array(
        'attr' => array('placeholder' => 'title')
    ))
            ->add('color', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'color',
                    'data-type' => 'color',
                    'value' => '#efefef'
                )))
            ->add('textColor', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'text color',
                    'data-type' => 'textcolor',
                    'value' => '#000000'
                )))
//            ->add('type', TextType::class, array(
//                'attr' => array('placeholder' => 'type')
//            ))
            ->add('latitude', TextType::class, array(
                'attr' => array('placeholder' => 'latitude')
            ))
            ->add('longitude', TextType::class, array(
            'attr' => array('placeholder' => 'longitude')
            ))
            ->add('radius', NumberType::class, array(
                'attr' => array('placeholder' => 'radius')
            ))
            ->add('hints', CollectionType::class, array(
            'entry_type' => HintType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'attr' => array('class' => 'hint')
            ));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'StoryBundle\Entity\Checkpoint'
        ));
    }
}
