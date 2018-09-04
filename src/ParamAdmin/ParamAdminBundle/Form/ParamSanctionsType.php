<?php

namespace ParamAdmin\ParamAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ParamSanctionsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('libel')
                ->add('description')
                ->add('amount')
                ->add('association', EntityType::class, 
                        [
                            'class' => 'ParamAdminBundle:SysAssociations',
                            'choice_label' => 'name',
                        ]
                    )
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ParamAdmin\ParamAdminBundle\Entity\ParamSanctions',
            'csrf_protection' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'paramadmin_paramadminbundle_paramsanctions';
    }


}
