<?php

namespace AppBundle\Controller\Profile;

use AppBundle\AppBundle;
use AppBundle\Entity\Commentaire;
use AppBundle\Entity\Prestataire;
use AppBundle\Form\EventListener\CommentListener;
use AppBundle\Form\Type\CommentaireType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{

    /**
     * @Route("/comment/internaute", name="commentaire_internaute_view")
     */
    public function viewCommentInternauteAction($internaute)
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('AppBundle\Entity\Commentaire');
        $commentaires = $repo->findBy(["internaute" => $internaute]);


        return $this->render('_partials/bloc/_bloc-commentaires.html.twig', ["commentaires" => $commentaires]);
    }

    /**
     * @Route("/prestataire/comment/{id}", name="prestataire_commentaire_view")
     */
    public function viewCommentPrestataireAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('AppBundle\Entity\Commentaire');
        $commentaires = $repo->findByPrestataire(["id" => $id]);


        return $this->render('_partials/bloc/_bloc-commentaires.html.twig', ["commentaires" => $commentaires]);
    }

    /**
     * @Route("/profile/comment/new", name="comment_create")
     */
    public function createAction(Request $request, Prestataire $prestataire = null)
    {


        $user = $this->get('app.verify_profile')->getUser();
        $comment = new Commentaire();

       $comment->setInternaute($user);
       $comment->setPrestataire($prestataire);

        $form = $this->createForm(CommentaireType::class, $comment/*,[
            'action' => $this->generateUrl('comment_create',["prestataire"=>$prestataire])
        ]*/);

        $form->handleRequest($request);

     if ($form->isValid()) {

            if ($this->get('app.persist_or_remove')->persist($comment)) {

                return new Response(' <div class="alert alert-icon alert-success" role="alert">
                               Votre commentaire a été envoyé !
                            </div>');
            } else die('nooooooooo');

        }



        return $this->render('profile/Comment/comment-create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/admin/comment/update", name="admin_comment_update")
     */
    public function updateAction(Request $request)
    {
        // ici viendra le code qui renvoie vers le formulaire update d'un comment (Admin)
        return $this->render('admin/comment/comment-update.html.twig');
    }

    /**
     * @Route("/admin/comment/delete", name="admin_comment_delete")
     */
    public function deleteAction(Request $request)
    {
        // ici viendra le code qui renvoie vers le formulaire suppression comment (Admin)
        return $this->render('admin/comment/comment-delete.html.twig');
    }


}
