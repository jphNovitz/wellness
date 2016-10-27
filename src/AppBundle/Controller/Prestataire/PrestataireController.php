<?php

namespace AppBundle\Controller\Prestataire;

use AppBundle\Entity\Commentaire;
use AppBundle\Entity\Image;
use AppBundle\Entity\Prestataire;
use AppBundle\Entity\Stage;
use Gedmo\Mapping\Annotation\Slug;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PrestataireController extends Controller
{
    /**
     * @Route("/prestataires/{pres}/{n}", name="prestataires_list"),
     * defaults={"pres": "list", "n":"null"}
     */
    public function listAction($pres = "list", $n = null)
    {

        if ($pres == "list") {

            return $this->render('public/Prestataires/prestataires-list.html.twig', ['n' => $n]);
        } else {
            return $this->render('public/prestataires/prestataires-grid.html.twig', ['n' => $n]);
        }

    }

    /**
     * prestataires_list list prends pends deux parametress
     *  - {pres} pour la présentation soit list soit grid.  Par defautt la valeur est à grid
     *  - {n} pour le nombre d'éléments à retourner
     *
     *  Cette Action se contente de retourner une vue qui fait un render controller de la liste ou de la grille
     *  L'objectif est des petit controlleurs et une vue en deux partie la vue 'generale' et le bloc liste de prestataires
     *  Pas certain que ce soit la meilleure solution / C'est plus lisible.
     */


    /**
     * @Route("/prestataires/last/{pres}/{n}", name="prestataires_last")
     */
    public function lastAction($pres, $n = null)
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('AppBundle\Entity\Prestataire');
        $prestataires = $repo->findLastN($n);
        if ($pres == "list") {
            return $this->render('_partials/_bloc-prestataires.html.twig', ['prestataires' => $prestataires]);
        } else {
            return $this->render('_partials/_bloc-prestataires-grid.html.twig', ['prestataires' => $prestataires]);
        }

    }

    /**
     * prestataires_last utilise findLastN qui est une methode personnalisée du repository
     * findlastN retourne les n derniers éléments
     * Une fois les n elements obtenu je renvoie vers le bloc de vue (un partial)
     * le but est que ce controller soit 'leger' et que le bloc soit réutilisable
     */

    /**
     * @Route("/prestataires/menu", name="prestataires_menu")
     */
    public
    function menuAction(Request $request, $max, $class = "")
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('AppBundle\Entity\Prestataire');
        $prestataires = $repo->findNames($max);

        return $this->render('_partials/_menu-elements.html.twig',
            ['elements' => $prestataires, 'chemin' => 'prestataires_list', 'class' => $class]);
    }


    /**
     * @Route("/prestataire/{slug}", name="prestataire_detail")
     * @ParamConverter("prestataire", class="AppBundle:Prestataire")
     */
    public function detailAction(Prestataire $prestataire)
    {
        $manager = $this->getDoctrine()->getManager();
        $stages = $manager->getRepository('AppBundle\Entity\Stage')->findByPrestataire($prestataire);
        $promos = $manager->getRepository('AppBundle\Entity\Promotion')->findByPrestataire($prestataire);


        return $this->render('public/prestataires/prestataire-detail.html.twig', [
            'prestataire' => $prestataire,
            'stages' => $stages,
            'promos' => $promos
        ]);
    }







}
