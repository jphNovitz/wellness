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
     * @Route("/stage", name="stages_list")
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
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if (!$user) {
            $this->addFlash('error', 'Nous avons rencontré un problème, veuillez assayer après reconexion');
            return $this->redirectToRoute('login');
        }
        // le code ci dessus ne sert probablement à rien
        $form = $this->createForm(StageType::class, $stage = new Stage());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $stage->setPrestataire($user);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($stage);

            $manager->flush();

            $this->addFlash('succes', 'Votre stage a été ajouté.');
            return $this->redirectToRoute('profile_update');

        }
        return $this->render('profile/stage/stage-create.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Route("/update/stage/{slug}", name="stage_update")
     * @ParamConverter("stage", class="AppBundle:Stage")
     */
    public function updateAction(Request $request, $stage)
    {
        $form = $this->createForm(StageType::class, $stage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($stage);
            $manager->flush();

            $this->addFlash('succes', 'Votre stage a été modifié.');
            return $this->redirectToRoute('profile_update');

        }
        return $this->render('/profile/stage:stage-up.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * @Route("/delete/Stage/{slug}", name="stage_delete")
     * @ParamConverter("stage", class="AppBundle:Stage")
     */
    public function deleteAction(Request $request, Stage $stage)
    {

        $form = $this->createFormBuilder($stage)
            ->add('supprimer', SubmitType::class, ['label' => 'OUI Supprimer !', 'attr' => ['class' => 'label label-lg label-danger']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager=$this->getDoctrine()->getManager();
            $manager->remove($stage);
            $manager->flush();

            $this->addFlash('succes', 'Stage Supprimé.');
            return $this->redirectToRoute('profile_update');


        }
        return $this->render('profile/stage/stage-delete.html.twig', ["stage"=>$stage, "form"=>$form->createView()]);
    }

}
