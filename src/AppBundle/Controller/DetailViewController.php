<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Archivierung;

class DetailViewController extends Controller
{
    /**
     * @Route("/archivierung/{archivId}",
     *     name="_detailView",
     *     requirements={"archivId": "\d+"}
     * )
     * @param $archivId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailViewAction($archivId)
    {
        // Archivierung aus DB auslesen
        $archivierung = $this->getArchivierung($archivId);

        $kategorie = $archivierung->getKategorie()->getBezeichnung();

        global $response;
        $response = null;

        if($kategorie == "Anleitung") {
            $response = $this->render(
                'archivierung/detailView/anleitung.html.twig',
                array('archivierung' => $archivierung)
            );
        }
        else{
            $response = $this->render(
                'archivierung/detailView/arbeit.html.twig',
                array('archivierung' => $archivierung)
            );
        }

        return $response;
    }


    private function getArchivierung($archivId)
    {
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