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
     * @Route("/profile/favoris", name="favoris")
     */
    public function listAction()
    {

        $fav = $this->getFav();

        return $this->render('profile/favoris.html.twig', ['providers' => $fav]);

    }

    /**
     * @Route("/profile/favoris", name="favoris")
     */
    public function lastAction()
    {

        $fav = $this->getFav(5);

        return $this->render('_partials/bloc/_bloc-prestataires.html.twig', ['prestataires' => $fav]);

    }

    /**
     * @Route("/profile/favoris/add/{slug}", name="favoris_add")
     * @ParamConverter("prestataire", class="AppBundle:Prestataire")
     */
    public function addAction(Prestataire $prestataire)
    {

        $user = $this->get('app.verify_profile')->getUser();

        $user->addFavori($prestataire);
        if ($this->get('app.persist_or_remove')->persist($user))
            return $this->redirectToRoute('favoris');

        return $this->redirectToRoute('homepage');
    }


    /**
     * @Route("/profile/favoris/remove/{slug}", name="favoris_remove")
     * @ParamConverter("prestataire", class="AppBundle:Prestataire")
     */
    public function removeAction(Prestataire $prestataire)
    {
        $user = $this->get('app.verify_profile')->getUser();

        $user->removeFavori($prestataire);
        if ($this->get('app.persist_or_remove')->persist($user))
            return $this->redirectToRoute('favoris');

        return $this->redirectToRoute('homepage');
    }

    private function getFav($n = null)
    {
        $user = $this->get('app.verify_profile')->getUser();

        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle:Prestataire');
        $fav = $repo->getFavoris($user);
        return $fav;
    }
}
