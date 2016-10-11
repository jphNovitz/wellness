<?php

namespace AppBundle\Controller\Service;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ServiceController extends Controller
{
    /**
     * @Route("/services", name="service_liste")
     */
    public function ListAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la liste des services
        return $this->render('public/services/service-liste.html.twig');
    }

    /**
     * @Route("/services", name="service_detail")
     */
    public function detailAction(Request $request)
    {
        // ici viendra le code qui renvoie vers le detail d'un service
        return $this->render('public/services/service-detail.html.twig');
    }




}
