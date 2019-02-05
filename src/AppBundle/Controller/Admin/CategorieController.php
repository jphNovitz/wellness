<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Categorie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CategorieController extends Controller
{

    /**
     * @Route(name="admin_categories_json_list")
     */
    public function jsonListAction($max = null, $orderby = 'DESC')
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Categorie');
        return new JsonResponse($repo->getList($max, $orderby));
    }
}
