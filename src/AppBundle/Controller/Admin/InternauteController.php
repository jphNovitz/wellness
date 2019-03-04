<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Internaute;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InternauteController extends Controller
{
    /**
     * @Route("/admin/internautes", name="admin_internautes_list")
     */
    public function listAction()
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Internaute');
        $users = $repo->getList();

        return $this->render('admin/Profile/internaute-list.html.twig', ['users' => $users, 'type'=>'internautes']);
    }

    /**
     * @Route("/admin/internaute/delete/{slug}", name="admin_internaute_delete")
     * @ParamConverter("internaute", class="AppBundle:Internaute")
     */
    public function deleteAction(Request $request, Internaute $internaute)
    {
        try {
            $user = $this->get('app.verify_profile')->checkUser('admin');
        } catch (\Exception $e) {
            $this->addFlash('error', "Cette zone n'est pas accessible !");
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createFormBuilder($internaute)
            ->add('supprimer', SubmitType::class, ['label' => 'OUI Supprimer !', 'attr' => ['class' => 'label label-lg label-danger']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            if ($this->get('app.persist_or_remove')->desactivate($internaute))
                return $this->redirectToRoute('admin_internautes_list');

        }

        return $this->render('admin/Profile/internaute-delete.html.twig', ["user" => $internaute, "form" => $form->createView()]);
    }

    /**
     * @Route("/admin/internaute/activate/{slug}", name="admin_internaute_activate")
     * @ParamConverter("internaute", class="AppBundle:Internaute")
     */
    public function activateAction(Request $request, Internaute $internaute)
    {
        if ($this->get('app.persist_or_remove')->activate($internaute)) {
            return $this->redirectToRoute('admin_internautes_list');
        } else {
            return false;
        }
    }


    /**
     * @Route("/admin/internautes/json", name="admin_internautes_json_list")
     */
    public function jsonListAction($max = null, $orderby = 'DESC')
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Internaute');
        return new JsonResponse($repo->getList($max, $orderby));
    }


    /**
     * @Route("/admin/profile/{slug}", name="admin_internaute_detail")
     */
    public function detailAction(Internaute $internaute){

        return $this->render('admin/Profile/internaute-card.html.twig', [
            'type' => 'internautes',
            'internaute' => $internaute
        ]);
    }
}
