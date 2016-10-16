<?php

namespace AppBundle\Controller\Prestataire;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PrestataireController extends Controller
{
    /**
     * @Route("/prestataire", name="prestataire_liste")
     */
    public function listAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('AppBundle\Entity\Prestataire');
        $prestataires = $repo->findAll();

        return $this->render('public/prestataires/prestataires-liste.html.twig', ['prestataires' => $prestataires]);
    }

    /**
     * @Route("/prestataire/menu", name="prestataire_menu")
     */
    public function menuAction(Request $request, $max)
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('AppBundle\Entity\Prestataire');
        $prestataires = $repo->findNames($max);

        return $this->render('_partials/_menu-elements.html.twig', ['elements' => $prestataires, 'chemin' => 'prestataire_liste']);
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
