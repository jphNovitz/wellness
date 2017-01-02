<?php

namespace AppBundle\Util;

use AppBundle\Entity\Image;
use AppBundle\Entity\Internaute;
use AppBundle\Entity\Prestataire;
use AppBundle\Entity\UserTemp;
use AppBundle\Entity\Utilisateur;
use Doctrine\ORM\EntityManager;


class PrepareBeforePersist
{

    protected $manager;
    public function __construct(EntityManager $entityManager)
    {
        $this->manager=$entityManager;
    }

    public function prestatairePersist(Prestataire $user, Image $image, UserTemp $test)
    {


        /* One To Many
         * => Je suis obligeé de persister mes données en deux étapes
        */
        $clone = clone $user->getLogos(); // je fais une copie des infos concernant le logo (many)
        $user->getLogos()->clear();       // je retire ces infos avant de persister l'utilisateur

      //  $manager = $this->getDoctrine()->getManager();
        $this->manager->persist($user);
        $this->manager->flush();

        /*
         * je set l'Url et la Description -  je sais que 0 est url et 1 description
         * to do: modifier pour une solution plus propre
         */

        $image->setUrl($clone->getValues()[0]);
        $image->setDescription($clone->getValues()[1]);
        $image->setImageType('logo');

        /*
         * Maintenant que j'ai flushé $user j'ai un id pour persister/flusher le Logo
         * C'est un many (logo) to one (user) mais je n'ajoute qu'un seul logo à la fois
         */
        $image->setPrestataireLogos($user);
        $this->manager->persist($image);
        //$this->manager->remove($test);
        if ($this->manager->flush()) return true;
        else return false;

    }

    public function internautePersist(Internaute $user, Image $image=null, UserTemp $test)
    {

        $clone = clone $user->getPhotos();
        $user->getPhotos()->clear();

        $this->manager->persist($user);
        $this->manager->flush();

        $image->setUrl($clone->getValues()[0]);
        $image->setDescription($clone->getValues()[1]);
        $image->setImageType('logo');

        $image->setInternautePhotos($user);
        $this->manager->persist($image);
        //$this->manager->remove($test);
        if ($this->manager->flush()) return true;
        else return false;

    }
}