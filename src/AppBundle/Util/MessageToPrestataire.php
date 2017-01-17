<?php
namespace AppBundle\Util;

use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Session\Session;

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

    public function sendMessage($message)
    {
        try {
            $message = \Swift_Message::newInstance()
                ->setSubject($message['sujet'])
                ->setFrom($message['source'])
                ->setTo($message['destination'])
                ->setBody($this->templating->render('emails/message-prestataire.html.twig', ["message" => $message]))
                ->setContentType("text/html");
            $this->mailer->send($message);
            $this->session->getFlashBag()->add('succes', 'Votre message a été envoyé');
        } catch (\Exception $e) {
            $this->session->getFlashBag()->add('danger', 'Suite à un problème votre message n\'a pas  été envoyé');
        }

    }
}