<?php

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PrestataireSearchType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('localite', TextType::class)
            ->add('service', EntityType::class,[
                'class' => 'AppBundle\Entity\Categorie',
                'choice_label' => 'nom'
            ])
            ->add('recherche', SubmitType::class)
            //  ->add('submit', submitType::class, ['label' => 'Ajout'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null
        ]);
    }

}
