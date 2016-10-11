<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{


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
