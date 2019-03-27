<?php

namespace AppBundle\Controller\Prestataire;

use AppBundle\Entity\Prestataire;
use AppBundle\Form\Type\PrestataireSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gedmo\Mapping\Annotation\Slug;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class SearchController extends Controller
{

    /**
     * @route("/prestataires/searchForm", name="prestataire_search_form")
     */
    public function searchFormAction(Request $request)
    {
        $form = $this->makeForm();

        return $this->render('forms/search-prestataire.html.twig', [
            'form' =>$form->createView()
        ]);
    }

    /**
     * @route("/prestataires/searchDisplay", name="prestataire_search_form-2")
     */
    public function searchForm2Action(Request $request)
    {
        // creation du formulaire
        $form = $this->makeForm();
        return $this->render('forms/search-standalone.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @route("/prestataires/s", name="prestataire_search")
     */
    public function searchAction(Request $request)
    {
        $raw = $request->request->get('prestataire_search');
        // recoite les variable
        $prestataire = $raw['nom'];
        $service = $raw['service'];
        $localite = $raw['localite'];

        // utilise les variables pour interroger le repository via la methode searchPrestataire

        $result = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle\Entity\Prestataire')
            ->searchPrestataire($prestataire, $localite, $service);

        // Renvoie le résultat à la vue
        return $this->render('public/Prestataires/prestataires-resultat.html.twig', ['prestataires' => $result]);


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

    public function makeForm(){
        return $this->createForm(PrestataireSearchType::class, null, [
            'action' => $this->generateUrl('prestataire_search')
        ]);
    }
}