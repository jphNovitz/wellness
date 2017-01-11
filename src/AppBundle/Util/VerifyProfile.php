<?php

namespace AppBundle\Util;

use AppBundle\Entity\Internaute;
use AppBundle\Entity\Prestataire;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class VerifyProfile
{
    protected $token;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->token = $tokenStorage;

    }

    public function getUser()
    {
        $user = $this->token->getToken()->getUser();
        if (!is_object($user)) {
            $this->addFlash('error', 'Veuillez vous reconnecter ou peut-être vous inscrire. ');
            return false;
        }
        return $user;
    }

    public function getClassName($user)
    {
        $class = explode('\\', get_class($user));
        $class = end($class); // en attendant de trouver mieux
        return strtolower($class);
    }

}