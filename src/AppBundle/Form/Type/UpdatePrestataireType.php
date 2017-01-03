<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Prestataire;
use AppBundle\Entity\Utilisateur;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class UpdatePrestataireType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('nom')
            //->add('adresseRue')
            //->add('adresseNum')
            //->add('localite', EntityType::class, ['class' => 'AppBundle\Entity\Localite'])
            ->add('perso', UpdateUserType::class,['data_class'=>Prestataire::class])
            ->add('siteWeb')
            ->add('tel')
            ->add('tva')
            ->add('categories', EntityType::class,
                ['class' => 'AppBundle\Entity\Categorie',
                    'choice_label' => 'nom',
                    'multiple' => true,
                    'expanded' => true])
            //->add('supprimer', SubmitType::class, ['label' => 'Supprimer mon profil !', 'attr' => array('class' => 'btn btn-danger')])
            //->add('submit', submitType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Prestataire::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_prestataire';
    }


}
