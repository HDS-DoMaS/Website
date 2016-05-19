<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ArchivAnhaenge;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Fachbereich;
use AppBundle\Entity\Studiengang;

class TestController extends Controller {
    /**
     * @Route("/fachbereich/{fachbereichId}", defaults={"fachbereichId" = null})
     */
    public function fachbereichAction($fachbereichId) {
        $fachbereich = $this->getDoctrine()
            ->getRepository('AppBundle:Fachbereich')
            ->find($fachbereichId);

        if (!$fachbereich) {
            throw $this->createNotFoundException(
                'Kein Fachbereich mit der id ' . $fachbereichId
            );
        }

        return $this->render(
            'test/fachbereich.html.twig',
            array('fachbereich' => $fachbereich)
        );
    }

    /**
     * @Route("/studiengang/{studiengangId}", defaults={"studiengangId" = null})
     */
    public function studiengangAction($studiengangId) {
        $studiengang = $this->getDoctrine()
            ->getRepository('AppBundle:Studiengang')
            ->find($studiengangId);

        if (!$studiengang) {
            throw $this->createNotFoundException(
                'Kein Studiengang mit der id ' . $studiengangId
            );
        }

        return $this->render(
            'test/studiengang.html.twig',
            array('studiengang' => $studiengang)
        );
    }
}