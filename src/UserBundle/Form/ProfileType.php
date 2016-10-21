<?php
/**
 * Created by PhpStorm.
 * User: alexf_000
 * Date: 10/21/2016
 * Time: 1:41 PM
 */

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;


class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('about', TextareaType::class,array(
            'required' => false,
            'label'     => 'profile.show.about',
            'translation_domain' => 'FOSUserBundle'
        ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getAbout()
    {
        return $this->getBlockPrefix();
    }
}