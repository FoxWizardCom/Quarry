<?php

namespace StoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HintType extends AbstractType
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
            ->add('question', TextType::class, array(
                'attr' => array('placeholder' => 'content')
            ))
            ->add('answer', TextType::class, array(
            'attr' => array('placeholder' => 'content')
            ))
            ->add('message', TextType::class, array(
            'attr' => array('placeholder' => 'content')
        ));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'StoryBundle\Entity\Hint'
        ));
    }
}
