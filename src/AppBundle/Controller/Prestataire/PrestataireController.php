<?php

namespace AppBundle\Controller\Prestataire;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PrestataireController extends Controller
{
    /**
     * @Route("/prestataires", name="prestataire_liste")
     */
    public function ListAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la liste des Prestataires
        return $this->render('public/prestataires/prestataires-liste.html.twig');
    }

    /**
     * @Route("/prestataire", name="prestataire_detail")
     */
    public function detailAction(Request $request)
    {
        // ici viendra le code qui renvoie vers le detail d'un Prestataire
        return $this->render('public/prestataires/prestataire-detail.html.twig');
    }

    /**
     * @Route("/s", name="prestataire_recherche")
     */
    public function rechercheAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la recherche d'un Prestataire
        return $this->render('public/prestataires/prestataire-recherche.html.twig');
    }


}
