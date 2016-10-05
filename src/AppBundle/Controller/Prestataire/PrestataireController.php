<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/prestataire", name="prestataire_liste)
     */
    public function listeAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la vue  liste des prestataires
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/prestataire/{id}", name="prestataire_detail)
     */
    public function detailAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la vue  detail d'un prestataire
        return $this->render('default/index.html.twig');
    }


}
