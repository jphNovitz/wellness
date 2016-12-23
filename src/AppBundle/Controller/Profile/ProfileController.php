<?php

namespace AppBundle\Controller\Profile;

use \AppBundle\Form\Type\InternauteType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProfileController extends Controller
{
    /**
     * @Route("/profile/", name="profile_detail")
     */
    public function viewAction(Request $request)
    {
        
        $internaute = $this->get('security.token_storage')->getToken()->getUser();
        $commentaires= $this->getDoctrine()->getManager()
            ->getRepository('AppBundle\Entity\Commentaire')
            ->findBy(['internaute'=>$internaute]);

        return $this->render('profile/profile-detail.html.twig', ['internaute'=> $internaute]);
    }

    /**
     * @Route("/update/profile", name="profile_update")
     */
    public function updateAction(Request $request)
    {

        try {
            if (!$internaute = $this->get('security.token_storage')->getToken()->getUser()) {

                throw new  \Exception();
            }


            $form=$this->createForm(InternauteType::class,$internaute);

            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {

                if ($form->get('supprimer')->isClicked()) {
                    return $this->redirectToRoute('internaute_delete');
                }

                if ($internaute->getConfirmation() == false) $internaute->setConfirmation(true);
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($internaute);
                $manager->flush();

                $this->addFlash('succes', 'Mise à jour effectuée avec succes');
                return $this->redirectToRoute('internaute_detail');


            }

            return $this->render('profile/profile-up.html.twig', ["form" => $form->createView()]);
        } catch (\Exception $e) {
            $this->addFlash('error', "Il y a eu un probleme.");
            return $this->redirectToRoute('homepage');

        }
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
