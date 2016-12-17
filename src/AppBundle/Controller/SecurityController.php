<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UserTemp;
use AppBundle\Entity\Internaute;
use AppBundle\Entity\Prestataire;
use AppBundle\Form\Type\UserTempType;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class SecurityController extends Controller
{

    /**
     * @Route("/essai", name="essai")
     */
    public function essaiAction()
    {
        /* $message = \Swift_Message::newInstance()
             ->setSubject('Hello Email')
             ->setFrom('essai@jiphi.be')
             ->setTo('hello@jiphi.be')
             ->setBody($this->renderView('emails/confirmation.txt.twig'), 'text/plain');
         $this->get('mailer')->send($message);
         return $this->redirectToRoute('homepage');*/
        $this->get('app.confirmation_mail')->sendConfirmation();

    }

    /**
     * @Route("/registration/{type}", name="registration", defaults={"type"= "internaute"})
     */
    public function registerAction(Request $request, $type)
    {

        /*
         * creation du formulaire après instanciation d'un nouvel utilisateur
         */
        $userTemp = new UserTemp();

        $form = $this->createForm(UserTempType::class, $userTemp);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            /*
             * ici j'ai remplacé l'encodage du mot de pass du controller par une fonction prePersist
             * dans un EventListener Doctrine
             */
            $userTemp->setType($type);

            // persist le prestataire
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($userTemp);
            $manager->flush();

            $this->get('app.confirmation_mail')->sendConfirmation($userTemp->getEmail(), $userTemp->getSalt());

            $this->addFlash('info', 'Nous vous avons envoyé un mail de confirmation !');
            return $this->redirectToRoute('homepage');

        }

        return $this->render('forms/Registration/register.html.twig', ["form" => $form->createView()]);


    }

    /**
     * @Route("/verification/{salt}", name="verification", defaults={"salt"="null"})
     */
    public function verificationAction(Request $request, $salt)
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\UserTemp');
        $test = $repo->findOneBy(["salt" => $salt]);

        if (!$test) {
            $this->addFlash('error', 'Il y eu un probleme ');
            return $this->redirectToRoute('homepage');
            /**
             * Dans l'entité UserTemp j'ai recherché l'utilisateur qui a le salt correspondant à celui fournit dans l'url
             * Si aucun utilisateur n'est trouvé on arrête ici
             * je renvoie à la page d'accueil avec un messageBag d'erreur
             * sinon on continue
             *
             *  $test est l'utilisateur que je retire de la Base de Donnée
             *  $user est celui de la verification je vois s'il est identique à test
             */

        }
        $user = new UserTemp();
        $form = $this->createForm(UserTempType::class, $user);
        $form->add("verif_token", HiddenType::class, ['data' => $salt, 'mapped' => false]);
        // je met le salt dans le formulaire créé
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form['verif_token']->getData() == $salt) {
                // j'ajoute une verification le verif_token caché dans le formulaire est-il le même que celui de l'url ?

                $user->setSalt($test->getSalt()); //je sais plus pourquoi
                /**
                 * j'ai créé un petit service qui encode le password fourni dans le form de verification
                 * il fait ensuite quelque test:
                 *  - serialize les deux objets en utilisant trois champs  et les COMPARE
                 *  - s'ils sont égaux -> verification par rapport à la date
                 *  -- la date de creation est-elle antérieure ou égale à sept jours avant ajd
                 *  --- Si oui alors l'inscription n'est plus valable
                 *  --- Sinon alors on continue
                 */
                if ($this->get('app.compare_json')->mEncode($user, $test)) {
                    $type = $test->getType();
                    // $user et $test sont identique alors je peux créer definitivement mon User
                    $class = 'AppBundle\Entity\\' . ucfirst($type);
                    $obj = new $class();
                    $obj->setRoles(['ROLE_PRESTATAIRE']);
                    $obj->setUsername($test->getUsername());
                    $obj->setEmail($test->getEmail());
                    $obj->setPassword($test->getPassword());
                    $obj->setSalt($test->getSalt());
                    $obj->setConfirmation(false);
                    $obj->setNom($test->getUsername());
                    $obj->setAdresseNum('');
                    $obj->setAdresseRue('');

                    if ($type == 'internaute') {
                        $obj->setNewsletter = true;

                    }


                    try {
                        $manager = $this->getDoctrine()->getManager();
                        $manager->persist($obj);
                        $manager->remove($test);
                        $manager->flush();

                        $this->addFlash('succes', 'Inscription Réussie !');
                    } catch (ORMException $e) {
                        $this->addFlash('error', 'Il y eu un probleme ');
                        return $this->redirectToRoute('homepage');

                    }

                    return $this->redirectToRoute($type . '_detail', ["slug" => $obj->getSlug()]);


                } else {

                    $this->addFlash('error', 'Il y eu un probleme ');

                    return $this->redirectToRoute('homepage');
                }


            }
        }
        return $this->render('forms/Registration/register.html.twig', ["form" => $form->createView()]);

    }


    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request)
    {

    }
}