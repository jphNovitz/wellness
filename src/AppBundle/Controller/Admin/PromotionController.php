<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Promotion;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PromotionController extends Controller
{

    /**
     * @Route(name="admin_promotions_json_list")
     */
    public function jsonListAction($max = null, $orderby = 'DESC')
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Promotion');
        return new JsonResponse($repo->getList($max, $orderby));
    }
}
