<?php
namespace AppBundle\Util;

use Symfony\Component\Templating\EngineInterface;

class ConfirmationMail
{
    protected $mailer;
    protected $templating;

    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function sendConfirmation($email, $salt)
    {

        $message = \Swift_Message::newInstance()
            ->setSubject('Votre inscription')
            ->setFrom('wellness@jiphi.be')
            ->setTo($email)
            ->setBody($this->templating->render('emails/confirmation.html.twig', ["mail" => $email, "salt" => $salt]))
            ->setContentType("text/html");
        $this->mailer->send($message);
        // return $this->redirectToRoute('homepage');

    }
}