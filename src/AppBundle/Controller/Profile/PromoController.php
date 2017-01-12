<?php

namespace AppBundle\Controller\Profile;

use AppBundle\Entity\Promotion;
use AppBundle\Form\Type\PromotionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

        try {
            $user = $this->get('app.verify_profile')->checkUser();
        }catch (\Exception $e){
            $this->addFlash('error',"Cette zone n'est pas accessible !");
            return $this->redirectToRoute('homepage');
        }
        $form = $this->createForm(PromotionType::class, $promo=new Promotion());

        $form->handleRequest($request);

        if ($form->isValid()) {
            $promo->setPrestataire($user);
            if ($this->get('app.persist_or_remove')->persist($promo))
                return $this->redirectToRoute('profile_update');
        }
        return $this->render('profile/promo/promo-create.html.twig', ['form' => $form->createView()]);


    }

    /**
     * @Route("/update/promo/{slug}", name="promo_update")
     * @ParamConverter("promo", class="AppBundle:Promotion")
     */
    public function updateAction(Request $request, $promo)
    {
        try {
            $user = $this->get('app.verify_profile')->checkUser();
        }catch (\Exception $e){
            $this->addFlash('error',"Cette zone n'est pas accessible !");
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createForm(PromotionType::class, $promo);
        $form->handleRequest($request);

        if ($form->isValid()) {

            if ($this->get('app.persist_or_remove')->persist($promo))
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
        try {
            $user = $this->get('app.verify_profile')->checkUser();
        }catch (\Exception $e){
            $this->addFlash('error',"Cette zone n'est pas accessible !");
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createFormBuilder($promo)
            ->add('supprimer', SubmitType::class, ['label' => 'OUI Supprimer !', 'attr' => ['class' => 'label label-lg label-danger']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            if ($form->isValid()) {

                if ($this->get('app.persist_or_remove')->remove($promo))
                    return $this->redirectToRoute('profile_update');
            }
            return $this->redirectToRoute('profile_update');


        }
        return $this->render('profile/promo/promo-delete.html.twig', ["promo"=>$promo, "form"=>$form->createView()]);
    }


}
