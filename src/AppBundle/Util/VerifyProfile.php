<?php

namespace AppBundle\Util;

use AppBundle\Entity\Internaute;
use AppBundle\Entity\Prestataire;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class VerifyProfile
{
    protected $token;
    protected $authorizationChecker;

    public function __construct(TokenStorageInterface $tokenStorage, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->token = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;

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

    /**
     * @return mixed
     * @throws \Exception
     *
     * methode checkUser
     * verification: l'utilisateur a-t-il le 'ROLE_PRESTATAIRE' ?
     * - Si l'utilisateur n'est pas un PRESTATAIRE -> retourne une AccessDeniedException
     * - Si la variable user n'est pas un objet c'est qu'il y a un probleme -> retourne aussi une exception
     */
    public function checkUser()
    {

            if (false === $this->authorizationChecker->isGranted('ROLE_PRESTATAIRE')) {
                throw new AccessDeniedException('vous n\'avez pas accès à cette zone');
            }
            $user = $this->token->getToken()->getUser();
            if (!is_object($user)) {
                throw new \Exception();
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