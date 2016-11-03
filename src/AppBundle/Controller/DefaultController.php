<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use Doctrine\ORM\Query;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Prestataire;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la vue  homepage
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la vue contact
        return $this->render('default/contact.html.twig');
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la vue about
        return $this->render('default/about.html.twig');
    }

    public function menuAction($max)
    {

        $prestataires = $this->get("utils")->findNames("Prestataire", $max);
        $services = $this->get("utils")->findNames("Categorie", $max);
        $stages = $this->get("utils")->findNames("Stage", $max);
        $promos = $this->get("utils")->findNames("Promotion", $max);

        return $this->render('_partials/menu/_menu-dyn.html.twig', [
            'prestataires' => $prestataires,
            'services' => $services,
            'stages' => $stages,
            'promos' => $promos,
            'class' => 'sub-menu']);


    }

}
