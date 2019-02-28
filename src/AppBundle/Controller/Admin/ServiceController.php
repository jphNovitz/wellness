<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Categorie;
use Doctrine\ORM\Persisters\PersisterException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ServiceController extends Controller
{

    /**
     * @Route("/admin/services", name="admin_services_list")
     */
    public function listAction()
    {
        $services = $this->get('doctrine.orm.default_entity_manager')
            ->getRepository('AppBundle:Categorie')
            ->getList();

        return $this->render('admin/Service/services-list.html.twig', [
            'type'=> 'service',
             'services'=> $services
        ]);
    }

    /**
     * @Route("/admin/service/{slug}", name="admin_service_detail")
     */
    public function detailAction(Categorie $service){

        return $this->render('admin/Service/service-card.html.twig', [
            'type' => 'services',
            'service' => $service
        ]);
    }

    /**
     * @Route("/admin/service/{slug}/delete", name="admin_service_delete", methods={"GET", "DELETE"})
     *
     */
    public function DeleteAction(Categorie $service, Request $request){
        if (!$service) {
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
                $this->get('app.persist_or_remove')->remove($service);
                $this->addFlash('success', 'Elément supprimé');
                return $this->redirectToRoute('admin_services_list');
            } catch (PersisterException $e){
                $this->addFlash('error', 'Action Impossible');
                return $this->redirectToRoute('admin_services_list');
            }
        }

        return $this->render('admin/Service/service-delete.html.twig', [
            'form' => $form->createView(),
            'service' => $service
        ]);
    }

}