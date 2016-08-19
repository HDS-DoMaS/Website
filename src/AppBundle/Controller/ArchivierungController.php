<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\KeywordType;
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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Form\Type\ArchivZusatzType;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Security\DomasUser;


class ArchivierungController extends Controller {

    private $grundPfad;
    private $anhaengePfad;

    public function __construct() {
        $this->grundPfad = $_SERVER["DOCUMENT_ROOT"] . "/../";
        $this->anhaengePfad = $this->grundPfad . "anhaenge/";
    }

    /**
     * @Route("/archivierung/neu",
     *     name="_neuArchivierung"
     * )
     */
    public function neuArchivierungAction(Request $request) {

        $isEmployeeOrAdmin = $this->get('security.authorization_checker')->isGranted(DomasUser::employeeRole);

        // Wenn nicht authorisiert:
        if (!$isEmployeeOrAdmin) {
            $this->addFlash('error',
                'Sie haben nicht die nötige Authorisierung, um eine Archivierung zu erstellen.');

            return $this->redirect($this->generateUrl('_default'));
        }

        // Neue Archivierung
        $archivierung = new Archivierung();
        $form = $this->getArchivierungForm($archivierung);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $archivierung->setBenutzer($this->getDoctrine()
                ->getRepository('AppBundle:Benutzer')
                ->find(1));

            $archivierung->setSichtbarkeit(true);
            $date = \DateTime::createFromFormat('Y-m-d',date('Y-m-d'));
            // echo $date->format('Y-m-d');
            $archivierung->setErstelldatum($date);

            $entityManager = $this->getDoctrine()->getManager();

            foreach ($archivierung->getZusaetze() as $zusatz) {
                // Kategorie Objekt setzten
                if(null == $zusatz->getZusatzKategorie()) {
                    $zusatz->setZusatzKategorie(
                        $this->getDoctrine()
                            ->getRepository('AppBundle:ArchivZusatzKategorie')
                            ->find($zusatz->getArchivZusatzKategorieId())
                    );
                }
            }

			$this->UploadAction($request);

            $entityManager->persist($archivierung);
            $entityManager->flush();

            $url = $this->generateUrl(
                '_detailView',
                array('archivId' => $archivierung->getArchivId())
            );
            return $this->redirect($url);
        }

        return $this->render(
            'archivierung/form.html.twig',
            array('form' => $form->createView())
        );
    }


    /**
     * @Route("/archivierung/bearbeiten/{archivId}",
     *     name="_editArchivierung",
     *     requirements={"archivId": "\d+"}
     * )
     */
    public function editArchivierungAction(Request $request, $archivId) {

        // Archivierung aus DB laden
        $archivierung = $this->getDoctrine()
            ->getRepository('AppBundle:Archivierung')
            ->find($archivId);

        $isAdmin = $this->get('security.authorization_checker')->isGranted(DomasUser::adminRole);
        $isErsteller = $this->UserIsErsteller($archivierung);

        // Wenn nicht authorisiert:
        if (!$isAdmin && !$isErsteller) {
            $this->addFlash('error',
                'Sie haben nicht die nötige Authorisierung, um diese Archivierung zu bearbeiten.');

            return $this->redirect($this->generateUrl('_default'));
        }

        // Ursprüngliche Zusatze
        $originalZusaetze = new ArrayCollection();
        foreach ($archivierung->getZusaetze() as $zusatz) {
            $originalZusaetze->add($zusatz);
        }

        // Ursprüngliche Keywords
        $originalKeywords = new ArrayCollection();
        foreach ($archivierung->getKeywords() as $keyword) {
            $originalKeywords->add($keyword);
        }

        // Formular erstellen
        $form = $this->getArchivierungForm($archivierung);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($archivierung->getZusaetze() as $zusatz) {
                // Kategorie Objekt setzten
                if(null == $zusatz->getZusatzKategorie()) {
                    $zusatz->setZusatzKategorie(
                        $this->getDoctrine()
                            ->getRepository('AppBundle:ArchivZusatzKategorie')
                            ->find($zusatz->getArchivZusatzKategorieId())
                    );
                }
            }

            // entfernte Zusatze löschen
            foreach ($originalZusaetze as $zusatz) {
                if (false === $archivierung->getZusaetze()->contains($zusatz)) {
                    $entityManager->remove($zusatz);
                }
            }

            // entfernte Keywords löschen
            foreach ($originalKeywords as $keyword) {
                if (false === $archivierung->getKeywords()->contains($keyword)) {
                    $entityManager->remove($keyword);
                }
            }

            $entityManager->persist($archivierung);
            $entityManager->flush();

            $url = $this->generateUrl(
                '_detailView',
                array('archivId' => $archivierung->getArchivId())
            );

            $url = $url . "/zurueck";

            return $this->redirect($url);
        }

        return $this->render(
            'archivierung/form-edit.html.twig',
            array('form' => $form->createView())
        );
    }

    private function getArchivierungForm($archivierung) {
        return $this->createFormBuilder($archivierung)
            ->add('titel', TextType::class)
            ->add('zusaetze', EntityType::class, array(
                'class' => 'AppBundle:ArchivZusatz',
                'choice_label' => 'bezeichnung'
            ))
            ->add('abgabedatum', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy'
            ))
            ->add('beschreibung', TextareaType::class)
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

            ->add('zusaetze', CollectionType::class, array(
                'entry_type' => ArchivZusatzType::class,
                'by_reference' => false,
                'allow_add'    => true,
                'allow_delete' => true,
            ))
            ->add('keywords', CollectionType::class, array(
                'entry_type' => KeywordType::class,
                'by_reference' => false,
                'allow_add'    => true,
                'allow_delete' => true,
            ))
            ->add('speichern', SubmitType::class)
            ->getForm();
    }


    /**
     * @Route("/archivierung/detail/zurueck",
     *     name="_detailViewBack"
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     * drücken des Zurückknopfes in der Detailview.
     * entscheiden welche auf welche seite der history redirected werden muss und diese dann aus der history löschen.
     */
    public function detailViewBackAction(Request $request) {

        $session = $request->getSession();
        $historyList = $session->get("historyList", array());   // wenn nicht: hitoryList = leeres array.
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
     * @param Request $request
     * @param string $zurueckButton
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function detailViewAction($archivId, Request $request, $zurueckButton = "errorString") {

        // Archivierung aus DB auslesen
        $archivierung = $this->getArchivierung($archivId);

        $isAdmin = $this->get('security.authorization_checker')->isGranted(DomasUser::adminRole);
        $isErsteller = $this->UserIsErsteller($archivierung);

        $sichtbarkeit = $archivierung->getSichtbarkeit();


        //LOGIK für den zurück-knopf:

        // session hohlen und gucken ob es schon eine history liste gibt
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

        // je nach referer entscheiden ob der history etwas hinzugefügt wird..

        //wenn es sich um eine detailView handelt, an die history anhängen.
        if($refererControllerId === "_detailView") {

            //ausser man befindet sich sowieso grade in einem zurück-request.
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
        // wenn man von der suchseite kommt hat, neue history erstellen und referer anhängen.
        elseif($refererControllerId === "_suche") {
            $historyList = array();
            array_push($historyList, $referer);
        }

        // wenn man grade von der editView kommt, nichts tun.
        elseif($refererControllerId === "_editArchivierung") {
            // mach nix
        }

        // wenn es keinen referer gibt, gibt es auch keine history
        else{
            $historyList = array();
        }

        $session->set("historyList", $historyList); // in der history speichern


        // RENDERN der View:
        $kategorie = $archivierung->getKategorie()->getBezeichnung();

        if($kategorie == "Anleitung") {
            return $this->render(
                'archivierung/detailView/anleitung.html.twig',
                array(  'archivierung'  => $archivierung,
                        'isAdmin'       => $isAdmin,
                        'isErsteller'   => $isErsteller,
                        'sichtbarkeit'  => $sichtbarkeit
                    )
            );
        }
        else{
            return $this->render(
                'archivierung/detailView/arbeit.html.twig',
                array(  'archivierung'  => $archivierung,
                    'isAdmin'       => $isAdmin,
                    'isErsteller'   => $isErsteller,
                    'sichtbarkeit'  => $sichtbarkeit
                )
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
     * öffnen eines Anhanges einer Archivierung mit vorherigem Authorisierungscheck
     */
    public function detailViewFileAction($anhangId) {

        //AnhangEntity aus DB laden
        $anhang = $this->getAnhang($anhangId);
        $archivierung = $anhang->getArchivierung();

        $isAdmin = $this->get('security.authorization_checker')->isGranted(DomasUser::adminRole);
        $isErsteller = $this->UserIsErsteller($archivierung);

        if ($anhang->getDateiKategorie()->getBezeichnung() === "Gutachten") {
            $sichtbarkeit = 0;  // Gutachten sind immer nicht sichtbar!
        }
        else {
            $sichtbarkeit = $archivierung->getSichtbarkeit();
        }

        // Wenn nicht authorisiert:
        if (!$sichtbarkeit && !$isErsteller && !$isAdmin) {
            $this->addFlash('error',
                'Sie haben nicht die nötige Authorisierung, um diesen Anhang zu öffnen.');

            return $this->redirect($this->generateUrl('_default'));
        }

        // DateiPfad
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
    }


    /**
     * @Route("/archivierung/delete/{archivId}",
     *     name="_deleteArchivierung")
     * @param Request $request
     * @param $archivId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteArchivierungAction(Request $request, $archivId) {     // TODO in PHPmyadmin testen

        // Benachrichtigung: wirklich löschen?
        $this->addFlash(
            'delete',
            'Möchten Sie die Archivierung wirklich löschen?'
        );

        // rendern der View
        return $this->redirectToRoute('_detailView', array('archivId' => $archivId, 'zurueckButton' => 'zurueck'));
    }

    /**
     * @Route("/archivierung/delete-confirm/{archivId}",
     *     name="_deleteConfirmArchivierung"
     * )
     * @param Request $request
     * @param $archivId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteConfirmArchivierungAction(Request $request, $archivId) {

        $archivierung = $this->getArchivierung($archivId);

        // Archivierung aus der DB entfernen
        $this->removeArchivierung($archivierung);

        // Benachrichtigung: Archivierung gelöscht
        $this->addFlash(
            'deleteSuccess',
            'Die Archivierung wurde gelöscht.'
        );

        // URL für weiterleitung
        $url = $this->generateUrl("_default");
        return $this->redirect($url);
    }



    /** aus einer URL die dazugehoerige ControllerFunktion finden
     */
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

    private function removeArchivierung($archivierung) {
        $entityManager = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) delete the Product (no queries yet)
        $entityManager->remove($archivierung);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
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

	public function UploadAction(Request $request)
    {
		$Archivname_Action = $this->getArchivierung($archivId); // für den Hauptordner einer Archivierung
		$Archiv_ID = $this->getAnhang($anhangId); //für Unterordner einer Archivierung

		$path = $this->get('kernel')->getRootDir().'/../anhaenge/'.$Archivname_Action.'/';
		$totalpath = $this->get('kernel')->getRootDir().'/../anhaenge/'.$Archivname_Action.'/'.$Archiv_ID.'/';

		//erste Überprüfung
		if(file_exists($path))
		{
			//do nothing
		}
		else
		{
		mkdir($path, 0700);
		}

		if(file_exists($totalpath))
		{
			//do nothing
		}
		else
		{
		mkdir($totalpath, 0700);
		}



		//$target_dir = $this->get('kernel')->getRootDir().'/../anhaenge/';

		$post = Request::createFromGlobals();

		if ($post->request->has('form_speichern'))
		{
			$filename= $request->files->get('fileToUpload');
			$target_file = $totalpath . basename($_FILES["fileToUpload"]["name"]);

			move_uploaded_file($filename, $target_file);


		}
		else
		{
			$name = 'Not submitted yet';

			return $this->render('archivierung/form.html.twig');
		}

    }
}