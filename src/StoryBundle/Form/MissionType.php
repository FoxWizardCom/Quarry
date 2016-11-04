<?php

namespace StoryBundle\Form;

use StoryBundle\Entity\Checkpoint;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionType extends AbstractType
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
                'attr' => array('placeholder' => 'content')
            ))
            ->add('title', TextType::class, array(
             'attr' => array('placeholder' => 'content')
            ))
            ->add('color', TextType::class, array(
                'attr' => array('placeholder' => 'content')
            ))
            ->add('type', TextType::class, array(
                'attr' => array('placeholder' => 'content')
            ))
            ->add('latitude', TextType::class, array(
                'attr' => array('placeholder' => 'content')
            ))
            ->add('longitude', TextType::class, array(
                'attr' => array('placeholder' => 'content')
            ))
            ->add('radius', TextType::class, array(
                'attr' => array('placeholder' => 'content')
            ))
            ->add('checkpoints', CollectionType::class, array(
            'entry_type' => CheckpointType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'attr' => array('class' => 'checkpoint')
    ));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'StoryBundle\Entity\Mission'
        ));
    }
}
