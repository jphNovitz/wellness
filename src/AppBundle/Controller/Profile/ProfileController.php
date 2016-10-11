<?php

namespace AppBundle\Controller\Profile;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{
    /**
     * @Route("/profile", name="profile_view")
     */
    public function viewAction(Request $request)
    {
        // ici viendra le code qui renvoie vers un profil
        return $this->render('profile/profiles/profile-detail.html.twig');
    }

    /**
     * @Route("/profile/update", name="profile_update")
     */
    public function updateAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la modification d'un profil
        return $this->render('profile/profiles/profile-up.html.twig');
    }

    /**
     * @Route("/profile/delete", name="profile_delete")
     */
    public function deleteAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la suppression d'un profil
        return $this->render('profile/profiles/profile-delete.html.twig');
    }

}
