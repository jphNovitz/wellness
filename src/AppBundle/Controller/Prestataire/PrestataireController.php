<?php

namespace AppBundle\Controller\Prestataire;

use AppBundle\Entity\Commentaire;
use AppBundle\Entity\Image;
use AppBundle\Entity\Prestataire;
use AppBundle\Entity\Stage;
use Gedmo\Mapping\Annotation\Slug;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PrestataireController extends Controller
{
    /**
     * @Route("/prestataires", name="prestataires_list"),
     */
    public function listAction(Request $request)
    {
        $n = $request->query->get('n');
        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Prestataire');
        $prestataires = $repo->myFindAll($n);

        return $this->render('public/Prestataires/prestataires-list.html.twig', ['prestataires' => $prestataires]);
    }


    /**
     * @Route("/prestataires/last", name="prestataires_last")
     */
    public function lastAction(Request $request)
    {
        $page = (empty($request->query->get('view'))) ? '_bloc-prestataires' : '_bloc-prestataires-grid';
        $n = $request->query->get('n');

        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('AppBundle\Entity\Prestataire');
        $prestataires = $repo->findLastN($n);

        return $this->render('_partials/bloc/' . $page . '.html.twig',
            ['prestataires' => $prestataires,
                'sm' => 12,  // les variables sm, md et lg servent à indiquer les largeur pour
                'md' => 3,   // les colonnes bootstrap
                'lg' => 3]);


    }

    /**
     * prestataires_last utilise findLastN qui est une methode personnalisée du repository
     * findlastN retourne les n derniers éléments
     * Une fois les n elements obtenu je renvoie vers le bloc de vue (un partial)
     * le but est que ce controller soit 'leger' et que le bloc soit réutilisable
     */

    /**
     * @Route("/prestataires/menu", name="prestataires_menu")
     */
    public
    function menuAction($max, $class = "")
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('AppBundle\Entity\Prestataire');
        $prestataires = $repo->findNames($max);

        return $this->render('_partials/menu-elements.html.twig',
            ['elements' => $prestataires, 'chemin' => 'prestataires_list', 'class' => $class]);
    }


    /**
     * @Route("/prestataire/{slug}", name="prestataire_detail")
     * @ParamConverter("prestataire", class="AppBundle:Prestataire")
     */
    public function detailAction(Prestataire $prestataire)
    {
        $manager = $this->getDoctrine()->getManager();
        $stages = $manager->getRepository('AppBundle\Entity\Stage')->findByPrestataire($prestataire);
        $promos = $manager->getRepository('AppBundle\Entity\Promotion')->findByPrestataire($prestataire);


        return $this->render('public/prestataires/prestataire-detail.html.twig', [
            'prestataire' => $prestataire,
            'stages' => $stages,
            'promos' => $promos
        ]);
    }

    /**
     * @route("/prestataires/searchForm", name="prestataire_form")
     */
    public function searchFormAction(Request $request)
    {
        // creation du formulaire
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('prestataire_form'))
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

             // je récupère les variable venant du formulaire -> je les transmets qu formulaire traitant la recherche
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
        $prestataire = empty($request->query->get('prestataire')) ? null : $request->query->get('prestataire') ;
        $service = empty($request->query->get('service')) ? null : $request->query->get('service') ;
        $localite = empty($request->query->get('localite')) ? null : $request->query->get('localite') ;
        /*$service = $request->query->get('service');
        $localite = $request->query->get('localite');*/

        // utilise les variables pour interroger le repository via la methode searchPrestataire

        $result = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle\Entity\Prestataire')
            ->searchPrestataire($prestataire, $localite, $service);

        // Renvoie le résultat à la vue
        return $this->render('public/Prestataires/prestataires-resultat.html.twig', ['prestataires' => $result]);


    }

}
