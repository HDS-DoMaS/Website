<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Archivierung;
use AppBundle\Entity\ArchivAnhang;
use AppBundle\Helper\MimeTypeHelper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class ArchivierungController extends Controller {

    private $grundPfad;

    public function __construct() {
        $this->grundPfad = $_SERVER["DOCUMENT_ROOT"] . "/DoMaS/anhaenge/";
    }


    /**
     * @Route("/archivierung/neu",
     *     name="_neuArchivierung"
     * )
     */
    public function neuArchivierungAction(Request $request) {
        // Neue Archivierung
        $archivierung = new Archivierung();

        // Formular erstellen
        $form = $this->getArchivierungForm($archivierung);
        $form->handleRequest($request);

        // Wurde das Formular abgesendet?
        if ($form->isSubmitted()) {

            // Ist das Forumlar valide?
            if($form->isValid()) {
                // Archivierung in der DB anlegen
                $this->saveArchivierung($archivierung);

                // Benachrichtigung: gespeichert
                $this->addFlash(
                    'success',
                    'Ihre Eingaben wurden erfolgreich gespeichert.'
                );
            }
            // Formular enthält Fehler
            else {

            }
        }
        return $this->render(
            'Archivierung/form.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }


    /**
     * @Route("/archivierung/bearbeiten/{archivId}",
     *     name="_editArchivierung",
     *     requirements={"archivId": "\d+"}
     * )
     */
    public function editArchivierungAction(Request $request, $archivId) {
        $archivierung = $this->getArchivierung($archivId);

        // Formular erstellen
        $form = $this->getArchivierungForm($archivierung);
        $form->handleRequest($request);

        // Wurde das Formular abgesendet?
        if ($form->isSubmitted()) {

            // Ist das Forumlar valide?
            if($form->isValid()) {
                $this->saveArchivierung($archivierung);

                // Benachrichtigung: gespeichert
                $this->addFlash(
                    'success',
                    'Ihre Eingaben wurden erfolgreich gespeichert.'
                );
            }
            // Formular enthält Fehler
            else {

            }
        }

        return $this->render(
            'archivierung/form-edit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }


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

        else{
            return $this->render(
                'archivierung/detailView/arbeit.html.twig',
                array('archivierung' => $archivierung)
            );
        }
    }

    /**
     * @Route("/archivierung/detail/anhang/{anhangId}",
     *     name="_detailViewFile",
     *     requirements={"anhangId": "\d+"}
     * )
     * @param $anhangId
     * @return \Symfony\Component\HttpFoundation\Response
     * öffnen eines Anhanges einer Archivierung mit vorheriger Authentifizierung
     */
    public function detailViewFileAction($anhangId) {

        // TODO UserId von Shibboleth bekommen

        $anhang = $this->getAnhang($anhangId);

        $archivierung = $anhang->getArchivierung();
        $erstellerId = $archivierung->getBenutzerId();

        $userId = 1;    //Test
        $adminId = 666;
        $profIds = [7,8,9]; //Test


        if($anhang->getDateiKategorie()->getBezeichnung() === "Gutachten") {
            $sichtbarkeit = 0;
        }
        else{
            $sichtbarkeit = $archivierung->getSichtbarkeit();
        }

        // checken ob Zugriff auf Path erlaubt
        if($sichtbarkeit === true ||$userId === $adminId || in_array($userId, $profIds) || $userId === $erstellerId) {

            // PDF returnen:
            $pfad = $this->grundPfad . "archivierung" . $anhang->getArchivId() . "/" . $anhangId . "/" . $anhang->getPfad();

            $mimeType = MimeTypeHelper::findMimeType($pfad);

            $response = new BinaryFileResponse($pfad);
            $response->trustXSendfileTypeHeader();
            $response->headers->set('Content-Type', $mimeType);

            global $dateiname;
            $dateiname = $anhang->getPfad();

            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $dateiname);

            $dateiname = null;
            return $response;
        }

        else{ // Nicht authorisierter Zugriff

            throw $this->createAccessDeniedException(
                'SIE HABEN KEINE ZUGRIFFSBERECHTIGUNG FÜR DIESEN ANHANG!'
            );
        }
    }


    private function getAnhang($anhangId) {
        $anhang = $this->getDoctrine()
            ->getRepository('AppBundle:ArchivAnhang')
            ->find($anhangId);

        // Keinen Anhang gefunden
        if (!$anhangId) {
            throw $this->createNotFoundException(
                'Keinen Anhang mit der id ' . $anhangId . ' gefunden!'
            );
        }

        return $anhang;
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

    private function getArchivierungForm($archivierung) {
        // Erzeugt ein Formular für das Objekt Archivierung
        $form = $this->createFormBuilder($archivierung)
            ->add('titel', TextType::class)
            ->add('beschreibung', TextType::class)
            ->add('fachbereich', EntityType::class, array(
                // query choices from this entity
                'class' => 'AppBundle:Fachbereich',
                // use the User.username property as the visible option string
                'choice_label' => 'bezeichnung',
                'placeholder' => 'Bitte wählen',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
            ))
            ->add('studiengang', EntityType::class, array(
                // query choices from this entity
                'class' => 'AppBundle:studiengang',
                // use the User.username property as the visible option string
                'choice_label' => 'bezeichnung',
                'placeholder' => 'Bitte wählen',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
            ))
            ->add('kategorie', EntityType::class, array(
                // query choices from this entity
                'class' => 'AppBundle:ArchivKategorie',
                // use the User.username property as the visible option string
                'choice_label' => 'bezeichnung',
                'placeholder' => 'Bitte wählen',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
            ))
            ->add('speichern', SubmitType::class)
            ->getForm();
        return $form;
    }

    private function saveArchivierung($archivierung) {
        $entityManager = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($archivierung);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
    }



    

}