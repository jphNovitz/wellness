<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Promotion;
use AppBundle\Form\Type\PromotionType;
use Doctrine\ORM\Persisters\PersisterException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PromotionController extends Controller
{

    /**
     * @Route("/admin/promotions", name="admin_promotions_list")
     */
    public function ListAction($max = null, $orderby = 'DESC')
    {
        $promos = $this->get('doctrine.orm.default_entity_manager')
                        ->getRepository('AppBundle\Entity\Promotion')
                        ->myFindAll();

        return $this->render('admin/Promotions/promotions-list.html.twig', [
            'promotions' => $promos,
            'type' => 'promotions'
        ]);
    }

    /**
     * @Route("/admin/promotion/{slug}", name="admin_promotion_detail")
     *
     */
    public function DetailAction(Promotion $promo){
        if (!$promo){
            return $this->redirectToRoute('admin_index');
        }
        return $this->render('admin/Promotions/promotion-card.html.twig', [
            "promotion" => $promo,
            'type' => 'promotions'
        ]);
    }

    /**
     * @Route("/admin/promotions/json", name="admin_promotions_json_list")
     */
    public function jsonListAction($max = null, $orderby = 'DESC')
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Promotion');
        return new JsonResponse($repo->getList($max, $orderby));
    }

    /**
     * @Route("/admin/promotion/{slug}/delete", name="admin_promotion_delete", methods={"GET", "DELETE"})
     *
     */
    public function DeleteAction(Promotion $promo, Request $request){
        if (!$promo) {
            $this->$this->addFlash('error', "Action Impossible !");
            return $this->redirectToRoute('admin_index');
        }

        $form = $this->createFormBuilder()
            ->setMethod('DELETE')
            ->add('supprimer', SubmitType::class, [
                'label' => 'OUI Supprimer !',
                'attr' => [
                    'class' => 'label label-lg label-danger'
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            try {
                $this->get('app.persist_or_remove')->remove($promo);
                $this->addFlash('success', 'Elément supprimé');
                return $this->redirectToRoute('admin_promotions_list');
            } catch (PersisterException $e){
                $this->addFlash('error', 'Action Impossible');
                return $this->redirectToRoute('admin_promotions_list');
            }
        }

        return $this->render('admin/Promotions/promotion-delete.html.twig', [
            'form' => $form->createView(),
            'promotion' => $promo
        ]);

    }
}
