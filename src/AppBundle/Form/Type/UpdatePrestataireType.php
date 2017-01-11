<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Prestataire;
use AppBundle\Entity\Stage;
use AppBundle\Entity\Utilisateur;
use AppBundle\Form\EventListener\PersistListener;
use AppBundle\Form\Type\StageType;
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
            ->add('perso', UpdateUserType::class, ['data_class' => Prestataire::class])
            ->add('siteWeb')
            ->add('tel')
            ->add('tva')
            ->add('categories', EntityType::class,
                ['class' => 'AppBundle\Entity\Categorie',
                    'choice_label' => 'nom',
                    'multiple' => true,
                    'expanded' => true])
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
