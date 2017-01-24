<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Categorie;
use AppBundle\Entity\Image;
use Doctrine\ORM\Query;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Prestataire;
use AppBundle\Repository\PrestataireRepository;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ImageController extends Controller
{
    /**
     * @Route("/profile/image", name="image_add")
     */
    public function indexAction(Request $request)
    {
        $user = $this->get('app.verify_profile')->checkUser('prestataire');

        $form = $this->createFormBuilder($image = new Image())
            ->add('url', UrlType::class)
            ->add('description', TextType::class)
            ->add('ajouter', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $image->setPrestataireLogos($user);
            $image->setImageType('logo');
            if ($this->get('app.persist_or_remove')->persist($image))
                return $this->redirectToRoute('profile_update');

        }

        return $this->render('forms/images-ajout.html.twig',["form"=>$form->createView()]);

    }
}