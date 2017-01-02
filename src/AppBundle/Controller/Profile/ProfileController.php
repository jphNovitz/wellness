<?php

namespace AppBundle\Controller\Profile;

use \AppBundle\Form\Type\InternauteType;

use AppBundle\Form\Type\PrestataireType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Form\Type\UpdatePrestataireType;

class ProfileController extends Controller
{
    /**
     * @Route("/profile/", name="profile_detail")
     */
    public function viewAction(Request $request)
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();
        if (get_class($user) == 'AppBundle\Entity\Prestataire') return $this->redirectToRoute('prestataire_detail', ["slug" => $user->getSlug()]);
        $commentaires = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle\Entity\Commentaire')
            ->findBy(['internaute' => $user]);

        return $this->render('profile/profile-detail.html.twig', ['internaute' => $user]);
    }

    /**
     * @Route("/update/profile", name="profile_update")
     */
    public function updateAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $class = explode('\\', get_class($user));
        $class= end($class); // en attendant de trouver mieux

        $form = $this->createForm(UpdatePrestataireType::class, $user);
       // if ($class == "Internaute") $form->add('prenom');

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('supprimer')->isClicked()) {
                return $this->redirectToRoute('prestataire_delete');
            }

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('succes', 'Mise à jour effectuée avec succes');
            return $this->redirectToRoute('profile_detail', ["slug" => $user->getSlug()]);


        }
        return $this->render('forms/update-prestataire.html.twig', ['form' => $form->createView()]);
    }



    /**
     * @Route("/profile/delete", name="profile_delete")
     */
    public function deleteAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $form = $this->createFormBuilder($user)
            ->add('supprimer', SubmitType::class, ['label' => 'OUI Supprimer !', 'attr' => ['class' => 'label label-lg label-danger']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // ici il y a quelque chose à implémenter pour la suppression
            die('a modifier: ajouter un champs bool actif');
            $this->getDoctrine()->getManager()->remove($user);

            $this->addFlash('success', 'l\'élement a bien été supprimé');
            $this->redirectToRoute('homepage');


        }

        return $this->render('profile/profile-delete.html.twig', ['user' => $user, 'form' => $form->createView()]);
    }

}
