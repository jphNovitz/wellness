<?php

namespace AppBundle\Doctrine;


use AppBundle\Entity\UserTemp;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;


Class EncodePasswordListener implements EventSubscriber
{

    protected $encoder;

    public function __construct(UserPasswordEncoder $encoder)
    {
        $this->encoder = $encoder;
    }

    public function getSubscribedEvents()
    {

        return ['prePersist', 'preUpdate'];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof UserTemp) return;
        $this->encodePwd($entity);

    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof UserTemp) return;

        $this->encodePwd($entity);

        // lignes nécéssaire pour pouvoir faire update
        $em = $args->getEntityManager();
        $meta = $em->getClassMetadata(get_class($entity));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);

    }

    /**
     * @param User $entity
     */
    private function encodePwd(User $entity)
    {

        if (!$entity->getPlainPassword()) {
            return;
        }
        $encoded = $this->encoder->encodePassword($entity, $entity->getPlainPassword(), $entity->getSalt());
        $entity->setPassword($encoded);
    }
}