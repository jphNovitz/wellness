<?php

namespace AppBundle\Controller\Profile;

use AppBundle\Entity\Stage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StageController extends Controller
{

    /*
     * Attention ne pas publier de modifier stage_list avec un id et tout ce qui va avec
     * stage_list est ici pour faire de la figuration pendant la construction du squelette Controllers/Vues
     */

    /**
     * @Route("/stage", name="stages_list")
     */
    public function listAction()
    {
        $manager=$this->getDoctrine()->getManager();
        $stages= $manager->getRepository('AppBundle\Entity\Stage')->myFindAll();

        return $this->render('profile/stage/stage-list.html.twig', ['stages'=>$stages]);
    }

    /**
     * @Route("/stage/{slug}", name="stage_detail")
     * @ParamConverter("stage", class="AppBundle:Stage")
     */
    public function detailAction(Stage $stage)
    {
        return $this->render('profile/stage/stage-detail.html.twig', ['stage'=>$stage]);
    }

    /**
     * @Route("/stage/new", name="stage_create")
     */
    public function createAction(Request $request)
    {
        // ici viendra le code qui renvoie vers un stage
        return $this->render('profile/profiles/stage-create.html.twig');
    }

    /**
     * @Route("/stage", name="stage_view")
     */
    public function viewAction(Request $request)
    {
        // ici viendra le code qui renvoie vers un stage
        return $this->render('profile/profiles/stage-detail.html.twig');
    }

    /**
     * @Route("/stage/update", name="stage_update")
     */
    public function updateAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la modification d'un stage
        return $this->render('profile/profiles/stage-update.html.twig');
    }

    /**
     * @Route("/stage/delete", name="stage_delete")
     */
    public function deleteAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la suppression d'un stage
        return $this->render('profile/profiles/stage-delete.html.twig');
    }

}
