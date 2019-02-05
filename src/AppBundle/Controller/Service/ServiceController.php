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
     * @Route("/services", name="services_list")
     * @Route("/services/")
     */
    public function listAction(Request $request)
    {
        $n = $request->request->get('n');

        $repo = $this->getDoctrine()->getRepository('AppBundle\Entity\Categorie');
        $categories = $repo->myFindAll($n);

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

        return $this->render('public/Services/service-detail.html.twig', ['service' => $category]);
    }

    /**
     * @Route("/service/widget_list", name="service_menu")
     */
    public function widgetListAction(Request $request)
    {
        $max=$request->query->get('max');
        $class=$request->query->get('class');

        $categories = $this
            ->getDoctrine()->getmanager()
            ->getRepository('AppBundle\Entity\Categorie')
            ->getList();

        return $this->render('_partials/menu/_menu-elements.html.twig',
            ['elements' => $categories,
                'chemin' => 'services_list',
                'class' => $class,
                'route' => 'service_detail']);
    }


}
