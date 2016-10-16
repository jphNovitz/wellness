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
    public function menuAction(Request $request, $max)
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('AppBundle\Entity\Categorie');
        $categories= $repo->findNames($max);

        return $this->render('_partials/_menu-elements.html.twig', ['elements' => $categories, 'chemin' => 'service_liste']);
    }

    /**
     * @Route("/service", name="service_liste")
     */
    public function listAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('AppBundle\Entity\Categorie');
        $categorie = $repo->findAll();

        return $this->render('public/Services/service-liste.html.twig', ['services' => $categorie]);
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
