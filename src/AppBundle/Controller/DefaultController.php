<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Categorie;
use Doctrine\ORM\Query;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Prestataire;
use AppBundle\Repository\PrestataireRepository;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig');

    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction(Request $request)
    {

        return $this->render('default/about.html.twig');
    }

    public function menuAction($max)
    {

        $em = $this->getDoctrine()->getManager();

        $prestataires = $em->getRepository('AppBundle\Entity\Prestataire')->getList($max);
        $services = $em->getRepository('AppBundle\Entity\Categorie')->getList($max);
        $stages = $em->getRepository('AppBundle\Entity\Stage')->getList($max);
        $promos = $em->getRepository('AppBundle\Entity\Promotion')->getList($max);

        return $this->render('_partials/menu/_menu-dyn.html.twig', [
            'prestataires' => $prestataires,
            'services' => $services,
            'stages' => $stages,
            'promos' => $promos,
            'class' => 'sub-menu']);


    }



}
