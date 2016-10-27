<?php

namespace AppBundle\Controller\Service;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ServiceController extends Controller
{
    /**
     * @Route("/service/menu", name="service_menu")
     */
    public function menuAction($max, $class = "")
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('AppBundle\Entity\Categorie');
        $categories = $repo->findNames($max);

        return $this->render('_partials/_menu-elements.html.twig',
            ['elements' => $categories, 'chemin' => 'service_liste', 'class'=>$class] );
    }


    /**
     * @Route("/service/list/{pres}/{n}", name="service_liste"),
     * defaults={"pres": "list"}
     */
    public function listAction($pres = "list", $n = null)
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('AppBundle\Entity\Categorie');
        $categorie = $repo->findAll();

        if ($pres == "list") {
            return $this->render('public/Services/services-list.html.twig', ['services' => $categorie]);
        } else  return $this->render('public/Services/services-grid.html.twig', ['services' => $categorie]);
    }

    /**
     * ListAction va rechercher tous les enregistements dans la BD,
     * ensuite renvoie vers la vue liste ou la vue grille
     */


    /**
     * @Route("/services", name="service_detail")
     */
    public function detailAction(Request $request)
    {
        // ici viendra le code qui renvoie vers le detail d'un service
        return $this->render('public/services/service-detail.html.twig');
    }


}
