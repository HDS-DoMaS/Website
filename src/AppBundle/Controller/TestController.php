<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ArchivAnhaenge;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Fachbereiche;
use AppBundle\Entity\Archivierung;
use AppBundle\Security\DomasUser;


class TestController extends Controller {

    /**
     * @Route("/test/{fachbereichId}", defaults={"fachbereichId" = null})
     */
    public function findAction($fachbereichId) {
        $fachbereich = $this->getDoctrine()
            ->getRepository('AppBundle:Fachbereiche')
            ->find($fachbereichId);

        if (!$fachbereich) {
            throw $this->createNotFoundException(
                'Kein Fachbereich mit der id ' . $fachbereichId
            );
        }

        $asdas = new Fachbereiche();

        return $this->render(
            'test/index.html.twig',
            array('fachbereich' => $fachbereich)
        );
    }


    /**
     * @Route("/test/user/{archivId}")
     */
    public function userTestAction($archivId) {     // TODO Testen

        // Archivierung aus DB auslesen
        $archivierung = $this->getArchivierung($archivId);

        $isAdmin = $this->get('security.authorization_checker')->isGranted(DomasUser::adminRole);
        $isErsteller = $this->UserIsErsteller($archivierung);
        $sichtbarkeit = $archivierung->getSichtbarkeit();

        if(!$isAdmin) {$isAdmin = "NOPE";}
        if(!$isErsteller) {$isErsteller = "NOPE";}
        if(!$sichtbarkeit) {$sichtbarkeit = "NOPE";}

        return $this->render('test/userTest.html.twig',
            array(  'archivierung'  => $archivierung,
                    'isAdmin' => $isAdmin,
                    'isErsteller' => $isErsteller,
                    'sichtbarkeit' => $sichtbarkeit,
            )
        );
    }


    private function getArchivierung($archivId) {
        $archivierung = $this->getDoctrine()
            ->getRepository('AppBundle:Archivierung')
            ->find($archivId);

        // Keine Archivierung gefunden
        if (!$archivierung) {
            throw $this->createNotFoundException(
                'Keine Archivierung mit der id ' . $archivId . ' gefunden!'
            );
        }

        return $archivierung;
    }


    /**
     * Prüft ob der aktuell eingeloggte User die $archivierung erstellt hat.
     */
    private function UserIsErsteller($archivierung) {
        $user = $this->getUser();

        if($user instanceof DomasUser) {    // Ausnahme bei admin! Dieser hat mit "isAdmin" ohnehin Berechtigung auf alles.
            return ($archivierung->getBenutzerId() === $user->getBenutzerId()); // todo testen
        }

        return false;
    }
}