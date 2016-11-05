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
     * @Route("/prestataires/{n}", name="prestataires_list"),
     * defaults={"n":"null"}
     */
    public function listAction($n = null)
    {
        return $this->render('public/Prestataires/prestataires-list.html.twig', ['n' => $n]);
    }


    /**
     * @Route("/prestataires/last/{n}", name="prestataires_last")
     */
    public function lastAction($n = null, $view=null)
    {
        $page = (empty($view)) ? '_bloc-prestataires' : '_bloc-prestataires-grid';
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('AppBundle\Entity\Prestataire');
        $prestataires = $repo->findLastN($n);

        return $this->render('_partials/bloc/'.$page.'.html.twig',
            ['prestataires' => $prestataires,
                'sm' => 12,  // les variables sm, md et lg servent à indiquer les largeur pour
                'md' => 3,   // les colonnes bootstrap
                'lg' => 3]);


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
    function menuAction($max, $class = "")
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('AppBundle\Entity\Prestataire');
        $prestataires = $repo->findNames($max);

        return $this->render('_partials/menu-elements.html.twig',
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
