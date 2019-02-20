<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Prestataire;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;

class APrestataireController extends Controller
{
    /**
     * @Route("/admin/prestataires", name="admin_prestataires_list")
     */
    public function listAction()
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Prestataire');
        $providers = $repo->getList();

        return $this->render('prestataires/prestataires-list.html.twig', ['providers' => $providers]);
    }

    /**
     * @Route("/admin/prestataire/delete/{slug}", name="admin_prestataire_delete")
     * @ParamConverter("prestataire", class="AppBundle:Prestataire")
     */
    public function deleteAction(Request $request, Prestataire $prestataire)
    {
        try {
            $user = $this->get('app.verify_profile')->checkUser('admin');
        } catch (\Exception $e) {
            $this->addFlash('error', "Cette zone n'est pas accessible !");
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createFormBuilder($prestataire)
            ->add('supprimer', SubmitType::class, ['label' => 'OUI Supprimer !', 'attr' => ['class' => 'label label-lg label-danger']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            if ($this->get('app.persist_or_remove')->desactivate($prestataire))
                return $this->redirectToRoute('admin_prestataires_list');

        }

        return $this->render('admin/Prestataires/prestataire-delete.html.twig', ["prestataire" => $prestataire, "form" => $form->createView()]);
    }

    /**
     * @Route("/admin/prestataire/activate/{slug}", name="admin_prestataire_activate")
     * @ParamConverter("prestataire", class="AppBundle:Prestataire")
     */
    public function activateAction(Request $request, Prestataire $prestataire)
    {
        if ($this->get('app.persist_or_remove')->activate($prestataire))
            return $this->redirectToRoute('admin_prestataires_list');
    }

    /**
     * @Route(name="admin_prestataires_json_list")
     */
    public function jsonListAction($max = null, $orderby = 'DESC')
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Prestataire');
        return new JsonResponse($repo->getList($max, $orderby));
    }

    /**
     * @Route("/admin/prestataire/{slug}", name="admin_prestataire_detail")
     */
    public function detailAction(Prestataire $prestataire){

        return $this->render('admin/Prestataires/prestataire-card.html.twig', [
            'type' => 'prestataires',
            'prestataire' => $prestataire
        ]);
    }


}
