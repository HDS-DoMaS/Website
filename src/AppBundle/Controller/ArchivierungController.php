<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Archivierung;
use AppBundle\Entity\ArchivAnhang;
use AppBundle\Entity\ArchivZusatz;
use AppBundle\Helper\MimeTypeHelper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Doctrine\ORM\EntityRepository;


class ArchivierungController extends Controller {

    private $grundPfad;
    private $anhaengePfad;

    public function __construct() {
        $this->grundPfad = $_SERVER["DOCUMENT_ROOT"] . "/DoMaS/";
        $this->anhaengePfad = $this->grundPfad . "anhaenge/";
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
            'archivierung/form.html.twig',
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
     * @Route("/archivierung/detail/zurueck",
     *     name="_detailViewBack"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     * drücken des Zurückknopfes in der Detailview
     */
    public function detailViewBackAction(Request $request) {

        $session = $request->getSession();
        $historyList = $session->get("historyList", array());
        $biggestIndex = sizeof($historyList)-1;


        // wenn es keine history gibt, zurueck zur suche springen
        if($historyList == null || $biggestIndex < 0 ) {
            $return = $this->redirect($this->generateUrl('_default'));
        }
        // ansonsten redirect zum letzten eintrag
        else{
            $url = $historyList[$biggestIndex];
            $urlControllerName = $this->URLToControllerName($url, $request);


            // wenn es sich um eine detailView handelt, dieser mitgeben dass sie nicht zum ersten mal aufgerufen wird.
            // dadurch wird ihr referer nicht erneut in die history eingetragen und es entsteht keine schleife.
            if($urlControllerName === "_detailView" && strpos($url, '/zurueck') === false) {
                $url = $url . '/zurueck';
            }

            // umleitung auf den jüngsten eintrag der history und anschließendes entfernen des eintrags
            $return = $this->redirect($url);
            array_splice($historyList, $biggestIndex, 1);
            $session->set("historyList", $historyList);
        }

        return $return;
    }


    /**
     * @Route("/archivierung/detail/{archivId}/{zurueckButton}",
     *     name="_detailView",
     *     defaults={"zurueckButton": "error"},
     *     requirements={"archivId": "\d+", "zurueckButton" : "[z][u][r][u][e][c][k]"}
     * )
     * @param integer $archivId
     * @param string $zurueckButton
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailViewAction($archivId, Request $request, $zurueckButton = "error") {
        // Archivierung aus DB auslesen
        $archivierung = $this->getArchivierung($archivId);

        //LOGIK für den zurück-knopf:
        // session hohlen und gucken ob schon history liste gibt
        $session = $request->getSession();
        $historyList = $session->get("historyList", array());


        // referer pathinfo auslesen
        $referer = $request->headers->get('referer');
        if($referer != null) {
            $refererControllerId = $this->URLToControllerName($referer, $request);
        }
        else{
            $refererControllerId = false;
        }

        // je nach referer entscheiden was mit der history für den zurückbutton passiert..

        //wenn es sich im eine detailView handelt, an die history anhängen.
        if($refererControllerId === "_detailView") {

            //ausser befindet sich sowie grade in einem zurück-request.
            if($zurueckButton !== "zurueck") {

                $biggestIndex = sizeof($historyList)-1;

                //checken ob man nicht die seite gerade nur refresht
                if ($biggestIndex < 0 || $referer != $historyList[$biggestIndex]) {
                    array_push($historyList, $referer);
                }
            }
            else{
                // Mach nichts.
            }

        }
        // wenn man von der suchseite kommt hat, neue history erstellen
        elseif($refererControllerId === "_suche") {
            $historyList = array();
            array_push($historyList, $referer);
        }
        // wenn es keinen referer gibt, gibt es auch keine history
        else{
            $historyList = array();
        }

        $session->set("historyList", $historyList); // save


        // RENDERN der View:
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
    public function detailViewFileAction($anhangId)
    {

        // TODO UserId von Shibboleth bekommen

        $anhang = $this->getAnhang($anhangId);

        $archivierung = $anhang->getArchivierung();
        $erstellerId = $archivierung->getBenutzerId();

        $userId = 1;    //Test
        $adminId = 666;
        $profIds = [7, 8, 9]; //Test


        if ($anhang->getDateiKategorie()->getBezeichnung() === "Gutachten") {
            $sichtbarkeit = 0;
        } else {
            $sichtbarkeit = $archivierung->getSichtbarkeit();
        }

        // checken ob Zugriff auf Path erlaubt
        if ($sichtbarkeit === true || $userId === $adminId || in_array($userId, $profIds) || $userId === $erstellerId) {

            // PDF returnen:
            $pfad = $this->anhaengePfad . "archivierung" . $anhang->getArchivId() . "/" . $anhangId . "/" . $anhang->getPfad();

            // den passenden mimeType zur file extension finden
            $mimeType = MimeTypeHelper::findMimeType($pfad);

            $response = new BinaryFileResponse($pfad);
            $response->trustXSendfileTypeHeader();
            $response->headers->set('Content-Type', $mimeType);


            $dateiname = $anhang->getPfad();

            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $dateiname);

            $dateiname = null;
            return $response;
        } else { // Nicht authorisierter Zugriff

            throw $this->createAccessDeniedException(
                'SIE HABEN KEINE ZUGRIFFSBERECHTIGUNG FÜR DIESEN ANHANG!'
            );
        }
    }


    // aus einer URL die passende ControllerFunktion finden
    private function URLToControllerName($url, $request) {
        $urlControllerName = false;   //fehlerfall

        if($url != null) {
            $urlFirstPart = explode('?', $url)[0];
            $urlMiddlePart = explode($request->getBaseURL(), $urlFirstPart)[1];

            $fullRoute = $this->get('router')->match($urlMiddlePart);
            $urlControllerPfad = $fullRoute['_controller'];
            $urlControllerFunction = explode("::", $urlControllerPfad)[1];
            $urlControllerName = "_" . explode("Action", $urlControllerFunction)[0];
        }

        return $urlControllerName;
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
        $zusatzMapper = $this->get('app.zusatz_kategorie_mapper');

        $erZusatz = $this->getDoctrine()
            ->getRepository('AppBundle:ArchivZusatz')
            ->createQueryBuilder('zusatz')
            ->join('zusatz.archivierungen', 'archivierung') // JOIN Fachbereich
            ->andWhere('archivierung.archivId = :archivId')
            ->setParameter('archivId', $archivierung->getArchivId())
            ->orderBy('zusatz.bezeichnung', 'ASC');

        // Erzeugt ein Formular für das Objekt Archivierung
        return $this->createFormBuilder($archivierung)
            ->add('archivId')
            ->add('titel', TextType::class)
            ->add('zusaetze', EntityType::class, array(
                'class' => 'AppBundle:ArchivZusatz',
                'choice_label' => 'bezeichnung'
            ))
            ->add('abgabedatum', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy'
            ))
            ->add('erstelldatum', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy'
            ))
            ->add('beschreibung', TextareaType::class)
            ->add('zusaetze', EntityType::class, array(
                'class' => 'AppBundle:ArchivZusatz',
                'query_builder' => $erZusatz,
                'choice_label' => 'bezeichnung',
            ))
            ->add('fachbereich', EntityType::class, array(
                'class' => 'AppBundle:Fachbereich',
                'choice_label' => 'bezeichnung'
            ))
            ->add('studiengang', EntityType::class, array(
                'class' => 'AppBundle:Studiengang',
                'choice_label' => 'bezeichnung'
            ))
            ->add('kategorie', EntityType::class, array(
                'class' => 'AppBundle:ArchivKategorie',
                'choice_label' => 'bezeichnung'
            ))
            ->add('benutzerId', HiddenType::class, array(
                'data' => '1'
            ))
            ->add('speichern', SubmitType::class)
            ->getForm();
    }

    private function saveArchivierung($archivierung) {
        $entityManager = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($archivierung);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
    }
}