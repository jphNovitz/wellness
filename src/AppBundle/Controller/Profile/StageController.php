<?php

namespace AppBundle\Controller\Profile;

use AppBundle\Entity\Prestataire;
use AppBundle\Entity\Stage;
use AppBundle\Form\Type\StageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class StageController extends Controller
{

    /**
     * @Route("/stages", name="stages_list")
     */
    public function listAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $stages = $manager->getRepository('AppBundle\Entity\Stage')->myFindAll();

        return $this->render('profile/stage/stage-list.html.twig', ['stages' => $stages]);
    }

    /**
     * @Route("/stage/{slug}", name="stage_detail")
     * @ParamConverter("stage", class="AppBundle:Stage")
     */
    public function detailAction(Stage $stage)
    {
        return $this->render('profile/stage/stage-detail.html.twig', ['stage' => $stage]);
    }

    /**
     * @Route("/profile/stage/new", name="stage_create")
     */
    public function createAction(Request $request)
    {
        try {
            $user = $this->get('app.verify_profile')->checkUser('prestataire');
        } catch (\Exception $e) {
            $this->addFlash('error', "Cette zone n'est pas accessible !");
            return $this->redirectToRoute('homepage');
        }
        $form = $this->createForm(StageType::class, $stage = new Stage());

        $form->handleRequest($request);

        if ($form->isValid()) {

            $stage->setPrestataire($user);
            if ($this->get('app.persist_or_remove')->persist($stage)) return $this->redirectToRoute('profile_update');
        }
        return $this->render('profile/stage/stage-create.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Route("profile/stage/update/{slug}", name="stage_update")
     * @ParamConverter("stage", class="AppBundle:Stage")
     */
    public function updateAction(Request $request, $stage)
    {
        try {
            $user = $this->get('app.verify_profile')->checkUser('prestataire');
        } catch (\Exception $e) {
            $this->addFlash('error', "Cette zone n'est pas accessible !");
            return $this->redirectToRoute('homepage');
        }
        $form = $this->createForm(StageType::class, $stage);
        $form->handleRequest($request);

        if ($form->isValid()) {

            if ($this->get('app.persist_or_remove')->persist($stage)) return $this->redirectToRoute('profile_update');

        }

        return $this->render('/profile/stage/stage-up.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/delete/Stage/{slug}", name="stage_delete")
     * @ParamConverter("stage", class="AppBundle:Stage")
     */
    public function deleteAction(Request $request, Stage $stage)
    {
        try {
            $user = $this->get('app.verify_profile')->checkUser('prestataire');
        } catch (\Exception $e) {
            $this->addFlash('error', "Cette zone n'est pas accessible !");
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createFormBuilder($stage)
            ->add('supprimer', SubmitType::class, ['label' => 'OUI Supprimer !', 'attr' => ['class' => 'label label-lg label-danger']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            if ($this->get('app.persist_or_remove')->remove($stage)) return $this->redirectToRoute('profile_update');

        }


        return $this->render('profile/stage/stage-delete.html.twig', ["stage" => $stage, "form" => $form->createView()]);
    }

}
