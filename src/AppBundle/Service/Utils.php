<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;


class Utils {

    protected $em;

    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }

    public function getList($entite) {

        $repo = $this->em->getRepository("AppBundle\Entity\\" . $entite);
        return $repo->myFindAll();
    }
    public function findNames($entite, $max=null)
    {
        $class="AppBundle\Entity\\".$entite;
        $repo = $this->em->getRepository($class);
        $noms = $this->em->createQuery('SELECT c.slug, c.nom FROM '.$class.' c ORDER BY c.id DESC')
            ->setMaxResults($max);
        return $noms->getResult();
    }
}
