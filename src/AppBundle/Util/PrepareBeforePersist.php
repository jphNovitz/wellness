<?php

namespace AppBundle\Util;

use AppBundle\Entity\UserTemp;
use AppBundle\Entity\Utilisateur;


class PrepareBeforePersist
{
    /**
     * @param UserTemp $test
     * @return mixed
     *
     * recoit l'utilisateur $test provenant de la BD
     * retour $obj qui est $test plus modifications
     *
     * Au moment de passer mon utilisateur de USerTemp à Prestataire ou Intenaute j'ai besoin de 'forcer' certains
     * champs en leur mettant un contenu à '' car dans le schema leur contenu ne peu pas être null
     * lors de l'inscription je n'ai entré que le username, le mail et le mot de pass.
     *
     * Ensuite je dois demander à l'utilisateur de competer son profil
     * to do: rediriger l'utilisateur vers l'update tant que le profil n'est pas completr au minimum
     *
     */
    public  function minimumToPersist(UserTemp $test)
    {
        $type = $test->getType();
// $user et $test sont identique alors je peux créer definitivement mon User
        $class = 'AppBundle\Entity\\' . ucfirst($type);
        $obj = new $class();
        $obj->setUsername($test->getUsername());
        $obj->setEmail($test->getEmail());
        $obj->setPassword($test->getPassword());
        $obj->setSalt($test->getSalt());
        $obj->setConfirmation(false);
        $obj->setNom($test->getUsername());
        $obj->setAdresseNum('');
        $obj->setAdresseRue('');

        if ($type == 'prestataire') {
            $obj->setRoles(['ROLE_PRESTATAIRE', 'ROLE_USER']);
        }

        if ($type == 'internaute') {
            $obj->setNewsletter = true;
            $obj->setRoles(['ROLE_INTERNAUTE', 'ROLE_USER']);

        }
        return $obj;
    }
}