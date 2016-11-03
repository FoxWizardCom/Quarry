<?php

namespace StoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            ->add('number')
            ->add('title')
            ->add('content')
            ->add('color')
            ->add('type')
            ->add('latitude')
            ->add('longitude')
            ->add('radius')
            ->add('mission')
            ->add('hints', CollectionType::class, array(
            'entry_type' => HintType::class,
            'allow_add' => true,
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
