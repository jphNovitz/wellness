<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/admin/prestataire", name="admin_prestataire_liste)
     */
    public function listeAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la vue  liste  admin des prestataires
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/admin/prestataire/create/{id}", name="admin_prestataire_create)
     */
    public function createAction(Request $request, $id)
    {
        // ici viendra le code qui renvoie vers le formulaire de creation d'un prestataire
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/admin/prestataire/update/{id}", name="admin_prestataire_update)
     */
    public function updateAction(Request $request, $id)
    {
        // ici viendra le code qui renvoie vers le formulaire de modification d'un prestataire
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/admin/prestataire/delete/{id}", name="admin_prestataire_delete)
     */
    public function deleteAction(Request $request, $id)
    {
        // ici viendra le code qui renvoie vers le formulaire de suppression d'un prestataire
        return $this->render('default/index.html.twig');
    }


}
