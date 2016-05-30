<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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


        //// PROVISIORISCH ZUM TESTEN
        return $this->render(
            'archivierung/detailView/bachelorarbeit.html.twig',
            array('archivierung' => $archivierung)
        );
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