<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SliderController extends Controller
{


    /**
     * @Route("/admin/slider/new", name="admin_slider_create")
     */
    public function createAction(Request $request)
    {
        // ici viendra le code qui renvoie vers le formulaire creation d'un slider (Admin)
        return $this->render('admin/slider/slider-create.html.twig');
    }

    /**
     * @Route("/admin/slider/update", name="admin_slider_update")
     */
    public function updateAction(Request $request)
    {
        // ici viendra le code qui renvoie vers le formulaire update d'un slider (Admin)
        return $this->render('admin/slider/slider-update.html.twig');
    }

    /**
     * @Route("/admin/slider/delete", name="admin_slider_delete")
     */
    public function deleteAction(Request $request)
    {
        // ici viendra le code qui renvoie vers le formulaire suppression slider (Admin)
        return $this->render('admin/slider/slider-delete.html.twig');
    }


}
