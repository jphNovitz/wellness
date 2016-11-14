<?php

namespace AppBundle\Controller\Profile;

use AppBundle\Entity\Promotion;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\Utils;

class PromoController extends Controller
{

    /**
     * @Route("/promo/menu", name="promo_menu")
     */
    public function menuAction(Request $request, $max, $class = "")
    {
        //$manager = $this->getDoctrine()->getManager();
        //$repo = $manager->getRepository('AppBundle\Entity\Promotion');
        //$promos = $repo->findNames($max);

        $promos= $this->get("utils")->findNames("Promotion",1);
        return $this->render('_partials/menu-elements.html.twig',
            ['elements' => $promos, 'chemin' => 'promo_list', 'class'=>$class] );
    }
    /**
     * @Route("/promo", name="promos_list")
     */
    public function listAction()
    {
        $manager=$this->getDoctrine()->getManager();
        $promos= $manager->getRepository('AppBundle\Entity\Promotion')->findAll();

        return $this->render('profile/promo/promo-list.html.twig', ['promos'=>$promos]);
    }

    /**
     * @Route("/promo/{slug}", name="promo_detail")
     * @ParamConverter("promo", class="AppBundle:Promotion")
     */
    public function detailAction(Promotion $promo)
    {


        return $this->render('profile/promo/promo-detail.html.twig', ['promos' => $promo ]);
    }

    /**
     * @Route("/promo/new", name="promo_create")
     */
    public function createAction(Request $request)
    {
        // ici viendra le code qui renvoie vers un promo
        return $this->render('profile/profiles/promo-create.html.twig');
    }

    /**
     * @Route("/promo/{id}", name="promo_view")
     */
    public function viewAction(Request $request)
    {
        // ici viendra le code qui renvoie vers un promo
        return $this->render('profile/profiles/promo-detail.html.twig');
    }

    /**
     * @Route("/promo/update", name="promo_update")
     */
    public function updateAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la modification d'un promo
        return $this->render('profile/profiles/promo-update.html.twig');
    }

    /**
     * @Route("/promo/delete", name="promo_delete")
     */
    public function deleteAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la suppression d'un promo
        return $this->render('profile/profiles/promo-delete.html.twig');
    }

}
