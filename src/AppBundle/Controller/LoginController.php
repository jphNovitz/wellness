<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{


    /**
     * @Route("/signup", name="signup")
     */
    public function signupAction(Request $request)
    {
        // ici viendra le code signup
        return $this->render('default/signup.html.twig');
    }

    /**
     * @Route("/recover", name="recover")
     */
    public function recoverAction(Request $request)
    {
        // ici viendra le code recover
        return $this->render('default/recover.html.twig');
    }

}
