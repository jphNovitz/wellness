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

        if ($entity_1->serialize() == $entity_2->serialize()){
            $days= $entity_2->getCreated()->diff(new\DateTime($now = 'NOW'))->d;

            if ($days <= 7) {
                return true;
            }
            else {
                return false;
            }
        }


    }

}