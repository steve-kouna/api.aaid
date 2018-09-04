<?php

namespace Member\MemberBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use ParamAdmin\ParamAdminBundle\Form\SysSessionsType;
use ParamAdmin\ParamAdminBundle\Form\SysAssociationsType;
use Member\MemberBundle\Form\SysMembersType;

/**
 * Description of AssociationsMembersInscriptionType
 *
 * @author Steve KOUNA
 */
class AssociationsMembersInscriptionType extends AbstractType {
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('associations', SysAssociationsType::class)
                ->add('sessions', SysSessionsType::class)
                ->add('members', SysMembersType::class)
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Member\MemberBundle\Entity\AssociationsMembersInscription',
            'csrf_protection' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'member_memberbundle_associationsmembersinscription';
    }

}
