<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Archivierung;

class ArchivierungController extends Controller {

    /////// DetailView
    /**
     * @Route("/archivierung/detail/{archivId}",
     *     name="_detailView",
     *     requirements={"archivId": "\d+"}
     * )
     * @param $archivId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailViewAction($archivId) {
        // Archivierung aus DB auslesen
        $archivierung = $this->getArchivierung($archivId);

        $kategorie = $archivierung->getKategorie()->getBezeichnung();

        if($kategorie == "Anleitung") {
            return $this->render(
                'archivierung/detailView/anleitung.html.twig',
                array('archivierung' => $archivierung)
            );
        }

        elseif(($kategorie == "Gutachten")) {

            return $this->render(
                'archivierung/detailView/gutachten.html.twig',
                array('archivierung' => $archivierung)
            );
        }

        else{
            return $this->render(
                'archivierung/detailView/arbeit.html.twig',
                array('archivierung' => $archivierung)
            );
        }
    }

    /**
     * @Route("/archivierung/detail/anhang/{path}",
     *     name="_detailViewFile"
     * )
     * @Method("POST")
     *
     * @param $path
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailViewFileAction($path, $erstellerId) {

        // checken ob Zugriff auf Path erlaubt
        // TODO wenn userId == erstellerId oder Admin oder Prof, und wenn referer = detailseite.
        // TODO PDF returnen




    }



    /////// Edit und Create

    // EBBI... <3







    /////// Private Methoden
    private function getArchivierung($archivId) {
        $archivierung = $this->getDoctrine()
            ->getRepository('AppBundle:Archivierung')
            ->find($archivId);

        // Keine Archivierung gefunden
        if (!$archivierung) {
            throw $this->createNotFoundException(
                'Keine Archivierung mit der id ' . $archivId . 'gefunden!'
            );
        }

        return $archivierung;
    }



}