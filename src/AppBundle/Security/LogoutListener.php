<?php

namespace AppBundle\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LogoutListener
 * @package AppBundle\Security
 *
 * Erstellt eine Flashnachricht und leitet dann auf das Anmeldeformular weiter.
 */
class LogoutListener implements LogoutSuccessHandlerInterface {

    private $router;
    private $session;

    public function __construct(Router $router, Session $session)
    {
        $this->session = $session;
        $this->router = $router;
    }


    public function onLogoutSuccess(Request $request) {

        // Sichergehen, dass Flashmessage nicht mehrfach angehangen wird.
        $flashBag = $request->getSession()->getFlashBag();
        if(!$flashBag->has("logout")) {
            $flashBag->add('logout', 'Sie haben sich erfolgreich ausgeloggt. Bitte schließen Sie aus Sicherheitsgründen ihren Browser.');
        }

        $responsePath = $this->router->generate('_login');
        $response = new RedirectResponse($responsePath);
        return $response;
    }

}
