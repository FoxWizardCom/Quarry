<?php

namespace StoryBundle\Form;

use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChapterType extends AbstractType
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
                    'rows' => '4',
                    'placeholder' => 'Write a chapter intro...'
            )))
            ->add('number', NumberType::class, array(
                'attr' => array('placeholder' => 'Which chapter is this?')
            ))
            ->add('title', TextType::class, array(
                'attr' => array('placeholder' => 'What is the Title?')
            ))
            ->add('color', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Give it some color',
                    'data-type' => 'color',
                    'value' => '#efefef'
             )))
            ->add('textColor', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'text color',
                    'data-type' => 'textcolor',
                    'value' => '#000000'
                )))
            ->add('type', TextType::class, array(
                'attr' => array('placeholder' => 'type')
            ))
            ->add('missions', CollectionType::class, array(
                'entry_type' => MissionType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'attr' => array('class' => 'mission')
            ));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'StoryBundle\Entity\Chapter'
        ));
    }
}
