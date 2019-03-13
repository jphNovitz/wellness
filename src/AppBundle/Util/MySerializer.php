<?php

namespace AppBundle\Util ;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class MySerializer{

    protected $serializer ;

    public function __construct()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function serialize($unserialized, $format = 'json')
    {
        return $this->serializer->serialize($unserialized, $format);
    }

    public function deserialize($serialized, $entity, $format = 'json')
    {
        return $this->serializer->deserialize($serialized, $entity, $format);
    }
}