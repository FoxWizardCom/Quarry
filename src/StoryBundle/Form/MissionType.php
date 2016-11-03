<?php

namespace StoryBundle\Form;

use StoryBundle\Entity\Checkpoint;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            ->add('number')
            ->add('title')
            ->add('content')
            ->add('color')
            ->add('type')
            ->add('latitude')
            ->add('longitude')
            ->add('radius')
            ->add('chapter')
            ->add('checkpoints', CollectionType::class, array(
            'entry_type' => CheckpointType::class,
            'allow_add' => true,
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
