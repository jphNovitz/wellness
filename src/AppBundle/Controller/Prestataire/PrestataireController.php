<?php

namespace AppBundle\Controller\Prestataire;

use AppBundle\Entity\Image;
use AppBundle\Entity\Prestataire;
use Gedmo\Mapping\Annotation\Slug;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PrestataireController extends Controller
{
    /**
     * @Route("/prestataire/list/{pres}/{n}", name="prestataire_liste")
     */
    public function listAction($pres = "grille", $n = null)
    {
        if ($pres == "liste") {

            return $this->render('public/Prestataires/prestataires-liste.html.twig', ['n' => $n]);
        } else {
            return $this->render('public/prestataires/prestataires-grille.html.twig', ['n' => $n]);
        }

    }

    /**
     * @Route("/prestataire/last/{pres}/{n}", name="prestataire_last")
     */
    public function lastAction($pres, $n = null)
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('AppBundle\Entity\Prestataire');
        $prestataires = $repo->findLastN($n);
        if ($pres == "liste") {
            return $this->render('_partials/_bloc-prestataires.html.twig', ['prestataires' => $prestataires]);
        } else {
            return $this->render('_partials/_bloc-prestataires-grille.html.twig', ['prestataires' => $prestataires]);
        }

    }

    /**
     * @Route("/prestataire/menu", name="prestataire_menu")
     */
    public
    function menuAction(Request $request, $max, $class = "")
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('AppBundle\Entity\Prestataire');
        $prestataires = $repo->findNames($max);

        return $this->render('_partials/_menu-elements.html.twig',
            ['elements' => $prestataires, 'chemin' => 'prestataire_liste', 'class' => $class]);
    }

    /**
     * @Route("/prestataire/{slug}", name="prestataire_detail")
     * @ParamConverter("Prestataire", class="AppBundle:Prestataire")
     */
    public function detailAction(Prestataire $prestataire)
    {
        /* $manager=$this->getDoctrine()->getManager();
         $repo=$manager->getRepository('AppBundle\Entity\Prestataire');
         $prestataire=$repo->findOneBySlug($slug);*/



        return $this->render('public/prestataires/prestataire-detail.html.twig', ['prestataire' => $prestataire]);
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
