<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class LoginController extends Controller {

    /**
     * @Route("/login", name="_login")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function LoginViewAction(Request $request) {

        // Wenn bereits eingeloggt:
        if ($this->get('security.authorization_checker')->isGranted("IS_AUTHENTICATED_FULLY")) {

            return $this->redirect($this->generateUrl('_default'));
        }

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        if($error) {
            $this->addFlash('error', 'Ungültige Eingabedaten!');
        }

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'security/login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername   , 'error' => $error
            )
        );
    }

    /**
     * @Route("/logoutRedirect", name="_logoutRedirector")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * Leitet nach erfolgreichem Logout auf die Loginseite weiter + Flashmessage.
     */
    public function LogoutRedirectAction() {

        $this->addFlash('logout', 'Sie haben sich erfolgreich ausgeloggt.  Bitte schließen Sie aus Sicherheitsgründen ihren Browser, um sicherzugehen, dass sich niemand mit Ihren Shibboleth-Daten einloggen kann.');

        return $this->redirect($this->generateUrl('_login'));
    }




}