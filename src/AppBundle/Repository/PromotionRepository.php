<?php

namespace AppBundle\Repository;

/**
 * PromotionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PromotionRepository extends \Doctrine\ORM\EntityRepository
{

    public function getList($max){
        $qb=$this->createQueryBuilder('pr');

        $qb->select('pr.slug, pr.nom, pr.fin')
            ->orderBy('pr.fin','ASC')
            ->setMaxResults($max);

        return $qb->getQuery()->execute();

    }

    public function myFindAll(){
        $qb=$this->createQueryBuilder('pr')
            ->leftJoin('pr.prestataire', 'p')
            ->leftJoin('pr.categorie', 'c')
            ->addSelect('c')
            ->addSelect('p');

        return $qb->getQuery()->getArrayResult();
    }

}
