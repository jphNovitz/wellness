<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class APrestataireController extends Controller
{
    /**
     * @Route("/admin/prestataires", name="admin_prestataire_list")
     */
    public function listAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la liste des prestataires (Admin)
        return $this->render('admin/prestataires/prestataires-liste.html.twig');
    }

    /**
     * @Route("/admin/prestataire/new", name="admin_prestataire_create")
     */
    public function createAction(Request $request)
    {
        // ici viendra le code qui renvoie vers le formulaire creation d'un prestataire (Admin)
        return $this->render('admin/prestataires/prestataires-create.html.twig');
    }

    /**
     * @Route("/admin/prestataire/update", name="admin_prestataire_update")
     */
    public function updateAction(Request $request)
    {
        // ici viendra le code qui renvoie vers le formulaire update d'un prestataire (Admin)
        return $this->render('admin/prestataires/prestataires-update.html.twig');
    }

    /**
     * @Route("/admin/prestataire/delete", name="admin_prestataire_delete")
     */
    public function deleteAction(Request $request)
    {
        // ici viendra le code qui renvoie vers le formulaire suppression d'un prestataire (Admin)
        return $this->render('admin/prestataire/prestataires-delete.html.twig');
    }


}
