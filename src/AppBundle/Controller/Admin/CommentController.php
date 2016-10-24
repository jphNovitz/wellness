<?php

namespace AppBundle\Controller\Admin;

use AppBundle\AppBundle;
use AppBundle\Entity\Commentaire;
use AppBundle\Entity\Prestataire;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{

    /**
     * @Route("/admin/comment/prestataire/{id}", name="prestataire_commentaire_view")
     */
    public function viewPrestataireAction($id)
    {
        $manager=$this->getDoctrine()->getManager();
         $repo=$manager->getRepository('AppBundle\Entity\Commentaire');
         $commentaires=$repo->findByPrestataire(["id"=>$id]);


        return $this->render('_partials/_bloc-commentaires.html.twig', ["commentaires"=>$commentaires]);
    }

    /**
     * @Route("/admin/comment/new", name="admin_comment_create")
     */
    public function createAction(Request $request)
    {
        // ici viendra le code qui renvoie vers le formulaire creation d'un comment (Admin)
        return $this->render('admin/comment/comment-create.html.twig');
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
