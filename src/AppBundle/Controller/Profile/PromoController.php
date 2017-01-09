<?php

namespace AppBundle\Controller\Profile;

use AppBundle\Entity\Promotion;
use AppBundle\Form\Type\PromotionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\Utils;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PromoController extends Controller
{


    /**
     * @Route("/promos", name="promos_list")
     */
    public function listAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $promos = $manager->getRepository('AppBundle\Entity\Promotion')->myFindAll();

        return $this->render('profile/promo/promo-list.html.twig', ['promos' => $promos]);
    }

    /**
     * @Route("/promo/{slug}", name="promo_detail")
     * @ParamConverter("promo", class="AppBundle:Promotion")
     */
    public function detailAction(Promotion $promo)
    {


        return $this->render('profile/promo/promo-detail.html.twig', ['promos' => $promo]);
    }

    /**
     * @Route("/profile/promo/new", name="promo_create")
     */
    public function createAction(Request $request)
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $form = $this->createForm(PromotionType::class, $promo=new Promotion());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $promo->setPrestataire($user);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($promo);

            $manager->flush();

            $this->addFlash('succes', 'Votre promotion a été ajouté.');
            return $this->redirectToRoute('profile_update');

        }
        return $this->render('profile/promo/promo-create.html.twig', ['form' => $form->createView()]);


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
     * @Route("/update/promo/{slug}", name="promo_update")
     * @ParamConverter("promo", class="AppBundle:Promotion")
     */
    public function updateAction(Request $request, $promo)
    {
        $form = $this->createForm(PromotionType::class, $promo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($promo);
            $manager->flush();

            $this->addFlash('succes', 'Votre stage a été modifié.');
            return $this->redirectToRoute('profile_update');

        }
        return $this->render('/profile/promo/promo-up.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * @Route("/delete/Promo/{slug}", name="promo_delete")
     * @ParamConverter("stage", class="AppBundle:Promotion")
     */
    public function deleteAction(Request $request, Promotion $promo)
    {

        $form = $this->createFormBuilder($promo)
            ->add('supprimer', SubmitType::class, ['label' => 'OUI Supprimer !', 'attr' => ['class' => 'label label-lg label-danger']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager=$this->getDoctrine()->getManager();
            $manager->remove($promo);
            $manager->flush();

            $this->addFlash('succes', 'Stage Supprimé.');
            return $this->redirectToRoute('profile_update');


        }
        return $this->render('profile/promo/promo-delete.html.twig', ["promo"=>$promo, "form"=>$form->createView()]);
    }


}
