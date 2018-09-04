<?php

namespace ParamAdmin\ParamAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Description of ContributionsEatType
 *
 * @author Steve KOUNA
 */
class ContributionsEatType extends AbstractType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('meeting', EntityType::class, 
                        [
                            'class' => 'ParamAdminBundle:ParamMeeting',
                            'choice_label' => 'name',
                        ]
                    )
                ->add('contributions', EntityType::class, 
                        [
                            'class' => 'ParamAdminBundle:ParamContributions',
                            'choice_label' => 'libel',
                        ]
                    )
//                ->add('sessions', EntityType::class, 
//                        [
//                            'class' => 'ParamAdminBundle:SysSessions',
//                            'choice_label' => 'name',
//                        ]
//                    )
//                ->add('associations', EntityType::class, 
//                        [
//                            'class' => 'ParamAdminBundle:SysAssociations',
//                            'choice_label' => 'name',
//                        ]
//                    )
                ->add('members', EntityType::class, 
                        [
                            'class' => 'MemberBundle:SysMembers',
                            'choice_label' => 'username',
                        ]
                    )
                    
                ->add('eat', EntityType::class, 
                        [
                            'class' => 'ParamAdminBundle:ParamEat',
                            'choice_label' =>  'id',
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
            'data_class' => 'ParamAdmin\ParamAdminBundle\Entity\ContributionsEat',
            'csrf_protection' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'paramadmin_paramadminbundle_contributionseat';
    }
}
