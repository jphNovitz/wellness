<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Utilisateur;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class UpdateUserType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('adresseRue')
            ->add('adresseNum')
            ->add('localite', EntityType::class, ['class' => 'AppBundle\Entity\Localite'])
            ->add('supprimer', SubmitType::class, ['label' => 'Supprimer mon profil !',
                'attr' => array('class' => 'btn btn-danger')])
            ->add('submit', submitType::class, ['label' => 'Mettre à jour']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'inherit_data' => true
        ));
    }



}
