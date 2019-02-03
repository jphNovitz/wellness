<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Prestataire;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class IndexController extends Controller
{
    /**
     * @Route("/admin/", name="admin_index")
     */
    public function inexAction()
    {
        return $this->render('admin/index.html.twig');
    }

}
