<?php

namespace AppBundle\Controller\Profile;

use AppBundle\Entity\Prestataire;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class FavorisController extends Controller
{

    /**
     * @Route("/profile/favoris/add/{slug}", name="favoris")
     * @ParamConverter("prestataire", class="AppBundle:Prestataire")
     */
    public function addAction(Prestataire $prestataire)
    {

        $user = $this->get('app.verify_profile')->getUser();
        $user->addFavori($prestataire);
        $this->get('app.persist_or_remove')->persist($user);

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/profile/favoris", name="favoris")
     */
    public function listAction(){
        $user = $this->get('app.verify_profile')->getUser();

        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle:Prestataire');
        $fav = $repo->getFavoris($user);
//var_dump($fav[0]);
        return $this->render('public/Prestataires/prestataires-list.html.twig', ['prestataires'=>$fav]);

    }
    /**
     * @Route("/profile/favoris/remove/{slug}", name="favoris_remove")
     * @ParamConverter("prestataire", class="AppBundle:Prestataire")
     */
    public function removeAction(Prestataire $prestataire)
    {
        $user = $this->get('app.verify_profile')->getUser();

        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle:Prestataire');
        $fav = $repo->getFavoris($user);

        foreach ($fav as $f) :
            var_dump($f);
        endforeach;

        die();

    }
/**
 * to do
 * le remove devient le liste
 * refaire un remove
 *
 */
}
