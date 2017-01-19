<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;

use AppBundle\Entity\Internaute;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Prestataire;
use AppBundle\Repository\PrestataireRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactController extends Controller
{
    /**
     * @Route("contact/prestataire/{slug}", name="contact_prestataire")
     * @ParamConverter("prestataire", class="AppBundle:Prestataire")
     */
    public function contactAction(Request $request, $prestataire)
    {
        $user = $this->get('app.verify_profile')->getUser();

        $form = $this->fBuilder();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $message = $this->get('app.message_to_prestataire')->composeMessage($form, $user, $prestataire);
            if ($this->get('app.message_to_prestataire')->sendMessage($message, true))
                return $this->redirectToRoute('prestataire_detail', [
                    "slug" => $prestataire->getSlug()
                ]);
            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/contact.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route("contact/admin", name="contact_wellness")
     */
    public function contactUsAction(Request $request, $prestataire = null)
    {
        $user = $this->get('app.verify_profile')->getUser();

        $form = $this->fBuilder();

        $form->handleRequest($request);

        if ($form->isValid()) {

           $message = $this->get('app.message_to_prestataire')->composeMessage($form, $user, $prestataire);

            if ($this->get('app.message_to_prestataire')->sendMessage($message, false))
                return $this->redirectToRoute('contact_page');
            return $this->redirectToRoute('homepage');
        }


        return $this->render('default/contact.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route("/contact", name="contact_page")
     */
    public function defaultContactAction(Request $request)
    {

        return $this->render('default/contact.html.twig');
    }


    private function fBuilder()
    {
        return $this->createFormBuilder()
            ->add('sujet', TextType::class)
            ->add('message', TextareaType::class)
            ->add('submit', SubmitType::class)
            ->getForm();
    }

   /* private function composeMessage($form, Internaute $user, Prestataire $prestataire = null)
    {
        $message['sujet'] = $form->get('sujet')->getData();
        $message['message'] = $form->get('message')->getData();
        $message['internaute'] = $user->getNom();
        $message['source'] = $user->getEmail();
        if ($prestataire) $message['destination'] = $prestataire->getEmail();
        else  $message['destination'] = 'fakemail@mailtrap.io';
        return $message;
    }*/
}
