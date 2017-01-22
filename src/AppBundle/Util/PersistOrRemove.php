<?php


namespace AppBundle\Util;

use AppBundle\Doctrine;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;


/**
 * Class PersistOrRemove
 * @package AppBundle\Util
 *
 * Service qui a pour utilité de persister, d'effacer ou de mettre inactif un user ou un objet
 * objectif: enlever du code des controller et diminuer la duplication de code
 *
 */
class PersistOrRemove
{

    protected $manager;
    protected $session;

    public function __construct(EntityManager $entityManager, Session $session)
    {
        $this->manager = $entityManager;
        $this->session = $session;
    }

    /**
     * @param $element
     * @return bool
     */
    public function persist($element)
    {
        try {
            $this->manager->persist($element);
            $this->manager->flush();
            $this->session->getFlashBag()->add('succes', 'Mise à jour effectuée ');

            return true;

        } catch (\Exception $e) {
            $this->session->getFlashBag()->add('error', 'Il y a eu une erreur');

            return false;

        }


    }

    public function remove($element)
    {

        try {
            $this->manager->remove($element);
            $this->manager->flush();
            $this->session->getFlashBag()->add('succes', 'Element supprimé ! ');

            return true;

        } catch (\Exception $e) {
            $this->session->getFlashBag()->add('error', 'Il y a eu une erreur');

            return false;

        }


    }

    /**
     * @param $element
     * @return bool
     */
    public function desactivate($element)
    {
        try {
            $element->setActif(false);
            $this->manager->persist($element);
            $this->manager->flush();
            $this->session->getFlashBag()->add('succes', 'Le  profil a été supprimé, il  n\'est plus visible sur notre plateforme');

            return true;

        } catch (\Exception $e) {
            $this->session->getFlashBag()->add('error', 'Il y a eu une erreur');

            return false;

        }


    }

    /**
     * @param $element
     * @return bool
     */
    public function activate($element)
    {
        try {
            $element->setActif(true);
            $this->manager->persist($element);
            $this->manager->flush();
            $this->session->getFlashBag()->add('succes', 'Le  profil a été activé, il est  visible sur notre plateforme');

            return true;

        } catch (\Exception $e) {
            $this->session->getFlashBag()->add('error', 'Il y a eu une erreur');

            return false;

        }


    }

}