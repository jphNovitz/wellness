<?php

namespace AppBundle\Controller\Prestataire;

use AppBundle\Entity\Commentaire;
use AppBundle\Entity\Image;
use AppBundle\Entity\Prestataire;
use AppBundle\Entity\Stage;
use AppBundle\Entity\Utilisateur;
use AppBundle\Form\Prestataire\PrestataireContactType;
use AppBundle\Form\Type\PrestataireType;
use Gedmo\Mapping\Annotation\Slug;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PrestataireController extends Controller
{
    /**
     * @Route("prestataires/{page}", name="prestataires_list", requirements={"page": "\d+"}),
     */
    public function listAction(Request $request, $page = 1)
    {
        //$n = $request->query->get('n');
        $prestataires_par_page = 10;
        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Prestataire');

        $prestataires = $repo->myFindAll($page);
        $prestataires_nombre = $repo->countPrestataires();
        $pages_nombre = ceil($prestataires_nombre / $prestataires_par_page);
        // ceil() arrondi à l'unité superieur ex 7 au lieu de 6.3

        return $this->render('public/Prestataires/prestataires-list.html.twig', [
            'prestataires' => $prestataires,
            'pagination' => [
                'page' => $page,
                'prestataire_nombre' => $prestataires_nombre,
                'pages_nombre' => $pages_nombre,
            ]
        ]);

    }


    /**
     * @Route("prestataires/last", name="prestataires_last")
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
     * @Route("prestataire/{slug}", name="prestataire_detail")
     * @ParamConverter("prestataire", class="AppBundle:Prestataire")
     */
    public function detailAction(Prestataire $prestataire, Request $request)
    {

        $manager = $this->getDoctrine()->getManager();
        $stages = $manager->getRepository('AppBundle\Entity\Stage')->findByPrestataire($prestataire);
        $promos = $manager->getRepository('AppBundle\Entity\Promotion')->findByPrestataire($prestataire);


        return $this->render('public/prestataires/prestataire-detail.html.twig', [
            'prestataire' => $prestataire,
            'stages' => $stages,
            'promos' => $promos,
            'request' => $request
        ]);
    }


    /**
     * @route("prestataire/update", name="prestataire_update")
     */
    public function updateAction(Request $request)
    {
        try {
            if (!$prestataire = $this->get('security.token_storage')->getToken()->getUser()) {
                throw new  \Exception();
            }


            $form = $this->createForm(PrestataireType::class, $prestataire);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                if ($form->get('supprimer')->isClicked()) {
                    return $this->redirectToRoute('prestataire_delete');
                }

                if ($prestataire->getConfirmation() == false) $prestataire->setConfirmation(true);
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($prestataire);
                $manager->flush();

                $this->addFlash('succes', 'Mise à jour effectuée avec succes');
                return $this->redirectToRoute('prestataire_detail', ["slug" => $prestataire->getSlug()]);


            }

            return $this->render('prestataires/prestataire-update.html.twig', ["form" => $form->createView()]);
        } catch (\Exception $e) {
            $this->addFlash('error', "Il y a un probleme, veuillez vous reconnecter.");
            return $this->redirectToRoute('homepage');

        }
    }


}
