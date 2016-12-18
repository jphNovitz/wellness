<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Categorie;
use Doctrine\ORM\Query;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Prestataire;
use AppBundle\Repository\PrestataireRepository;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        return $this->render('default/index.html.twig');

    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la vue contact
        return $this->render('default/contact.html.twig');
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction(Request $request)
    {
        // ici viendra le code qui renvoie vers la vue about
        return $this->render('default/about.html.twig');
    }

    public function menuAction($max)
    {

        $em = $this->getDoctrine()->getManager();

        $prestataires = $em->getRepository('AppBundle\Entity\Prestataire')->getList($max);
        $services = $em->getRepository('AppBundle\Entity\Categorie')->getList($max);
        $stages = $em->getRepository('AppBundle\Entity\Stage')->getList($max);
        $promos = $em->getRepository('AppBundle\Entity\Promotion')->getList($max);

        return $this->render('_partials/menu/_menu-dyn.html.twig', [
            'prestataires' => $prestataires,
            'services' => $services,
            'stages' => $stages,
            'promos' => $promos,
            'class' => 'sub-menu']);


    }

    /**
     * @Route("/search_lite", name="search_lite")
     */
    public function searchLiteAction(Request $request)
    {
        $formLite = $this->createFormBuilder()
            ->setAction($this->generateUrl('search_lite'))
            ->add('search', searchType::class)
            ->getForm();
        $formLite -> handleRequest($request);

        // si le formulaire a été soumis -> je le traite
        if ($formLite->isSubmitted() && $formLite->isValid()) {
            $s = $formLite['search']->getData();

            $prestataires = $this
                ->getDoctrine()->getManager()
                ->getRepository('AppBundle\Entity\Prestataire')
                ->searchPrestataire($s);
            return $this->render('public/Prestataires/prestataires-resultat.html.twig', ['prestataires' => $prestataires]);
        }

        return $this->render('forms/search-lite.html.twig', ['formLite' => $formLite->createView()]);
    }

}
