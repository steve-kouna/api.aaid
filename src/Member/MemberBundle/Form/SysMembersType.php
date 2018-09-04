<?php

namespace Member\MemberBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class SysMembersType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('roles')
                ->add('email', EmailType::class)
                ->add('plainPassword')
                ->add('username')
                ->add('firstname')
                ->add('lastname')
                ->add('dateBirth')
                ->add('sexe')
                ->add('cniNumber')
                ->add('dateCniDeliver')
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Member\MemberBundle\Entity\SysMembers',
            'csrf_protection' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'member_memberbundle_sysmembers';
    }


}
