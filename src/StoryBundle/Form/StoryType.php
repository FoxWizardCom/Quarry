<?php

namespace StoryBundle\Form;

use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StoryType extends AbstractType
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
                    'rows' => '3',
                    'placeholder' => 'Write a story intro...'
                )))
            ->add('number', NumberType::class, array(
                'attr' => array(
                    'placeholder' => 'Number')
            ))
            ->add('title', TextType::class, array(
                'attr' => array('placeholder' => 'Title')
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
            ->add('chapters', CollectionType::class, array(
                'entry_type' => ChapterType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'attr' => array('class' => 'chapter')
                ));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'StoryBundle\Entity\Story'
        ));
    }
}
