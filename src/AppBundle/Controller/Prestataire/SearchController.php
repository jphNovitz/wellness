<?php

namespace AppBundle\Controller\Prestataire;

use AppBundle\Entity\Prestataire;
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
        // creation du formulaire
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('prestataire_search_form'))
            ->setMethod('GET')
            ->add('prestataire', searchType::class, ['required' => false])
            ->add('localite', searchType::class, ['required' => false])
            ->add('service', searchType::class, ['required' => false])
            ->add('recherche', submitType::class)
            ->getForm();

        $form->handleRequest($request);

        // si le formulaire a été soumis -> je le traite
        if ($form->isSubmitted() && $form->isValid()) {
            $p = $form['prestataire']->getData();
            $l = $form['localite']->getData();
            $s = $form['service']->getData();

            // je récupère les variable venant du formulaire -> je les transmets au formulaire traitant la recherche
            return $this->redirectToRoute('prestataire_search', [
                'prestataire' => $p,
                'localite' => $l,
                'service' => $s
            ]);
        }
        //si le formumaine n'a pas été soumis alors il est affiché
        return $this->render('forms/search.html.twig', ['form' => $form->createView()]);

    }


    /**
     * @route("/prestataires/s", name="prestataire_search")
     */
    public function searchAction(Request $request)
    {

        // recoit les variable
        $prestataire = $request->query->get('prestataire');
        $service = $request->query->get('service');
        $localite = $request->query->get('localite');


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
}