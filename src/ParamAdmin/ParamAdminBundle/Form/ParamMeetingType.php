<?php

namespace ParamAdmin\ParamAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ParamMeetingType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name')
                ->add('receptionDate', DateType::class, [
                    'widget' => 'single_text'
                ])
                ->add('place')
                ->add('sessions', EntityType::class, 
                        [
                            'class' => 'ParamAdminBundle:SysSessions',
                            'choice_label' => 'name',
                        ]
                    )
                ->add('associations', EntityType::class, 
                        [
                            'class' => 'ParamAdminBundle:SysAssociations',
                            'choice_label' => 'name',
                        ]
                    )
                ->add('members', EntityType::class, 
                        [
                            'class' => 'MemberBundle:SysMembers',
                            'choice_label' => 'username',
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
            'data_class' => 'ParamAdmin\ParamAdminBundle\Entity\ParamMeeting',
            'csrf_protection' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'paramadmin_paramadminbundle_parammeeting';
    }


}
