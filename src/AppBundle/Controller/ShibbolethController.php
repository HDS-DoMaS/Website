<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class ShibbolethController extends Controller {
	private $firewall = 'main';
	private $returnToRoute = '_default';

    /**
     * @Route("/login/shibboleth", name="_shibbolethLogin")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function LoginAction() {
		// web/shibboleth.php übernimmt authetifizierung
        return $this->redirect('/shibboleth.php');
    }
	
	/**
     * @Route("/login/shibboleth/redirect/{flag}", name="_shibbolethRedirect")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function RedirectAction(Request $request, $flag) {
		// Wurde kein Flag übergeben?
		if(empty($flag)) {
			// Fehler: Es wurde kein Flag übergeben
			$this->session->getFlashBag()->add('error', 'Der Shibboleth-Login ist fehlgeschlagen. Fehlermeldung: NO_FLAG');

			$this->returnToRoute = '_login';
		} else {
			// Benutzer anhand Flag ermitteln
			$benutzer = $this->getDoctrine()
				->getRepository('AppBundle:Benutzer')
				->findOneBy(
					array('flag' => $flag)
				);

			// Wurde kein Benutzer gefunden?
			if (!$benutzer) {
				// Fehler: Benutzer wurde nicht gefunden
				$this->session->getFlashBag()->add('error', 'Der Shibboleth-Login ist fehlgeschlagen. Fehlermeldung: NO_USER');
				$this->returnToRoute = '_login';
			} else {
				// Login-Token erstellen
				$token = new UsernamePasswordToken(
					$benutzer, 						// Benutzer
					null,							// Passwort
					$this->firewall,				// Firewall
					array($benutzer->getDomasRole())// Rollen
				);

				// Smyfony Authentifizierung über Login-Token
				$this->get('security.token_storage')->setToken($token);
				$this->get('session')->set('_security_' . $this->firewall, serialize($token));

				// Flag leeren
				$this->clearFlag($benutzer);
			}
		}

		// Zur ermittelten Route weiterleiten
		return $this->redirect($this->generateUrl($this->returnToRoute));
	}

	private function clearFlag($benutzer) {
		// Benutzer Flag leeren
		$benutzer->setFlag('');

		// Objekt persistieren
		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($benutzer);
		$entityManager->flush();
	}
}