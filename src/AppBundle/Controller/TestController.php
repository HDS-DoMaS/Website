<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Archivierung;
use AppBundle\Security\DomasUser;


class TestController extends Controller {
/*
    /**
     * @Route("/test/{fachbereichId}", defaults={"fachbereichId" = null})
     *
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
*/

    /**
     * @Route("/test/user")
     */
    public function userTestAction() {
        $Ersteller = false;

        $isAdmin = $this->get('security.authorization_checker')->isGranted(DomasUser::adminRole);
        if(!$isAdmin) {
            $Ersteller = $this->getUser()->getBenutzerId();
        }

        if(!$isAdmin) {$isAdmin = "NOPE";}
        if(!$Ersteller) {$Ersteller = "NOPE";}

        return $this->render('test/userTest.html.twig',
            array(  'isAdmin' => $isAdmin,
                    'Ersteller' => $Ersteller
            )
        );
    }

}