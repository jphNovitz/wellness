<?php

namespace AppBundle\Controller\Profile;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Form\Type\UpdatePrestataireType;
use AppBundle\Form\Type\UpdateInternauteType;

class ProfileController extends Controller
{


    /**
     * @Route("/profile/", name="profile_detail")
     */
    public function viewAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $user = $this->get('app.verify_profile')->getUser();

        if ($this->get('app.verify_profile')->getClassName($user) == 'prestataire') {

            $promos = $manager->getRepository('AppBundle:Promotion')->getListByUser($user);
            $stages = $manager->getRepository('AppBundle:Stage')->getListByUser($user);

            return $this->render('public/Prestataires/prestataire-detail.html.twig', [
                'prestataire' => $user,
                'promos' => $promos,
                'stages' => $stages]);

        } else {
            $commentaires = $manager->getRepository('AppBundle\Entity\Commentaire')
                ->findBy(['internaute' => $user]);

            return $this->render('profile/profile-detail.html.twig', [
                'internaute' => $user,
                'commentaires' => $commentaires]);
        }
    }

    /**
     * @Route("/profile/update", name="profile_update")
     */
    public function updateAction(Request $request)
    {
        $user = $this->get('app.verify_profile')->getUser();
        if (!$user) return $this->redirectToRoute('login');

        $userType = $this->get('app.verify_profile')->getClassName($user);

        switch ($userType):
            case "prestataire":
                $manager = $this->getDoctrine()->getManager();
                $stages = $manager->getRepository('AppBundle:Stage')->getListByUser($user);
                $promos = $manager->getRepository('AppBundle:Promotion')->getListByUser($user);
                $form = $this->createForm(UpdatePrestataireType::class, $user);
                break;

            case "internaute":
                $form = $this->createForm(UpdateInternauteType::class, $user);
                break;

        endswitch;

        $form->handleRequest($request);

        if ($form->isValid()) {

            if ($form->get('perso')->get('supprimer')->isClicked()) return $this->redirectToRoute('profile_delete');
            if (!$this->get('app.persist_or_remove')->persist($user)) return $this->redirectToRoute('/');

            else return $this->redirectToRoute('profile_detail');
        }

        return $this->render('forms/update-' . $userType . '.html.twig', ['form' => $form->createView(), 'stages' => $stages, 'promos' => $promos]);
    }


    /**
     * @Route("/profile/delete", name="profile_delete")
     */
    public function deleteAction(Request $request)
    {
        $user = $this->get('app.verify_profile')->getUser();

        $form = $this->createFormBuilder($user)
            ->add('supprimer', SubmitType::class, ['label' => 'OUI Supprimer !', 'attr' => ['class' => 'label label-lg label-danger']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
           $this->get('app.persist_or_remove')->desactivate($user);
            return $this->redirectToRoute('homepage');

        }

        return $this->render('profile/profile-delete.html.twig', ['user' => $user, 'form' => $form->createView()]);
    }


}
