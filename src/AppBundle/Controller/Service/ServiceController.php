<?php

namespace AppBundle\Controller\Service;

use Doctrine\ORM\Query;
use Entity\Categorie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Tests\Constraints\CollectionValidatorCustomArrayObjectTest;

class ServiceController extends Controller
{
    /**
     * @Route("/service/menu", name="service_menu")
     */
    public function menuAction($max, $class = "")
    {
        $categories = $this->get("utils")->findNames("Categorie", $max);

        return $this->render('_partials/menu/_menu-elements.html.twig',
            ['elements' => $categories,
                'chemin' => 'services_list',
                'class' => $class,
                'route' => 'service_detail']);
    }


    /**
     * @Route("/services", name="services_list")
     */
    public function listAction(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle\Entity\Categorie');
        /*$categories = $repo->createQueryBuilder('q')
            ->getQuery()
            ->getArrayResult();
        $categories = json_encode($categories);*/
        $categories = $repo->findAll();

        return $this->render('public/Services/services-list.html.twig', ['services' => $categories]);

    }

    /**
     * ListAction va rechercher tous les enregistements dans la BD,
     * ensuite renvoie vers la vue liste ou la vue grille
     */


    /**
     * @Route("/service/{slug}", name="service_detail"),
     * @ParamConverter ("Categorie", class="AppBundle:Categorie")
     */
    public function detailAction(\AppBundle\Entity\Categorie $category)
    {

        return $this->render('public/services/service-detail.html.twig', ['service' => $category]);
    }


}
