<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class PrestataireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('utilisateur', UtilisateurType::class,
                ['data_class' => 'AppBundle\Entity\Prestataire'])
            ->add('siteWeb')
            ->add('tel')
            ->add('tva')
            ->add('categories', EntityType::class,
                ['class' => 'AppBundle\Entity\Categorie',
                    'choice_label' => 'nom',
                    'multiple' => true,
                    'expanded' => true])
            ->add('submit', submitType::class)
            ->add('supprimer', SubmitType::class, ['label' => 'Supprimer mon profil !', 'attr' => array('class' => 'btn btn-danger')]);


        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Prestataire'
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
