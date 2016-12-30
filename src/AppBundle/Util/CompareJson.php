<?php

namespace AppBundle\Util;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;


class CompareJson {

    protected $encoder;

    public function __construct( $encod)
    {
        $this->encoder=$encod;
    }

    public function mEncode($entity_1, $entity_2){


        $encoded = $this->encoder->encodePassword($entity_1,$entity_1->getPlainPassword());
        $entity_1->setPassword($encoded);

        /**
         * au dessus j'encode le password pour pouvoir le comparer
         * en dessous je compare les deux entites après serialisation, s'ils ne sont pas exactement égaux c'est qu'il y a un probleme
         * s'ils sont égaux je verifie que l'utilisateur ne s'est pas inscrit il y a plus de sept jours.
         * s'il a mit trop de temps il devra recommencer
         */


        if ($entity_1->serialize() == $entity_2->serialize()){

            $days= $entity_2->getCreated()->diff(new\DateTime($now = 'NOW'))->d;

            if ($days <= 7) {
                return true;
            }
            else {
                return false;
            }
        }
        else  return false;


    }

}