<?php

namespace ParamAdmin\ParamAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class SysSessionsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name')
                ->add('beginDate', DateType::class, [
                    'widget' => 'single_text'
                ])
                ->add('endDate', DateType::class, [
                    'widget' => 'single_text'
                ])
                ->add('active')
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ParamAdmin\ParamAdminBundle\Entity\SysSessions',
            'csrf_protection' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'paramadmin_paramadminbundle_syssessions';
    }


}
