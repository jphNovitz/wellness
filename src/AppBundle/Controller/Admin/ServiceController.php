<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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

}