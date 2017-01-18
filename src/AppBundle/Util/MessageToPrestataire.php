<?php
namespace AppBundle\Util;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Internaute;
use AppBundle\Form;

class MessageToPrestataire
{
    protected $mailer;
    protected $templating;
    protected $session;

    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating, Session $session)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->session = $session;
    }


    public function composeMessage($form, Internaute $user, Prestataire $prestataire = null)
    {
        $message['sujet'] = $form->get('sujet')->getData();
        $message['message'] = $form->get('message')->getData();
        $message['internaute'] = $user->getNom();
        $message['source'] = $user->getEmail();
        if ($prestataire) $message['destination'] = $prestataire->getEmail();
        else  $message['destination'] = 'fakemail@mailtrap.io';
        return $message;
    }

    public function sendMessage($message, $prest = false)
    {

        if ($prest) $model = 'emails/message-prestataire.html.twig';
        else $model = 'emails/message-admin.html.twig';

        try {
            $message = \Swift_Message::newInstance()
                ->setSubject($message['sujet'])
                ->setFrom($message['source'])
                ->setTo($message['destination'])
                ->setContentType("text/html")
                ->setBody($this->templating->render($model, ["message" => $message]));
            $this->mailer->send($message);
            $this->session->getFlashBag()->add('succes', 'Votre message a été envoyé');
            return true;
        } catch (\Exception $e) {
            $this->session->getFlashBag()->add('danger', 'Suite à un problème votre message n\'a pas  été envoyé');
            return false;
        }

    }
}