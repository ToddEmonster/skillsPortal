<?php

namespace App\Form;

use App\Entity\Profile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idProfile')
            ->add('firstName')
            ->add('lastName')
            ->add('jobTitle')
            ->add('position')
            ->add('email')
            ->add('tel')
            ->add('creationDate')
            ->add('lastEditDate')
            ->add('address')
            ->add('postalCode')
            ->add('city')
            ->add('apsideBirthday')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
        ]);
    }
}
