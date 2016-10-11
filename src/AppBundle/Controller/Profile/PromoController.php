<?php

namespace AppBundle\Controller\Profile;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PromoController extends Controller
{

    /*
     * Attention ne pas publier de modifier promo_list avec un id et tout ce qui va avec
     * Promo_list est ici pour faire de la figuration pendant la construction du squelette Controllers/Vues
     * De toute façon si je le fais pas ca marchera pas
     */

    /**
     * @Route("/promo", name="promo_list")
     */
    public function listAction(Request $request)
    {
        // ici viendra le code qui renvoie vers une liste de promos
        return $this->render('profile/profiles/promo-liste.html.twig');
    }

    /**
     * @Route("/promo/new", name="promo_create")
     */
    public function createAction(Request $request)
    {
        // ici viendra le code qui renvoie vers un promo
        return $this->render('profile/profiles/promo-create.html.twig');
    }

    /**
     * @Route("/promo", name="promo_view")
     */
    public function viewAction(Request $request)
    {
        // ici viendra le code qui renvoie vers un promo
        return $this->render('profile/profiles/promo-detail.html.twig');
    }

    /**
     * @Route("/promo/update", name="promo_update")
     */
    public function updateAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la modification d'un promo
        return $this->render('profile/profiles/promo-update.html.twig');
    }

    /**
     * @Route("/promo/delete", name="promo_delete")
     */
    public function deleteAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la suppression d'un promo
        return $this->render('profile/profiles/promo-delete.html.twig');
    }

}
