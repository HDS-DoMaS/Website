<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ArchivAnhaenge;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Fachbereiche;

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

// TEST MARIUS
}