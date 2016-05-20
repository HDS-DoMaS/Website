<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Fachbereich;

class FachbereichController extends Controller {
    /**
     * @Route("/fachbereiche",
     *     name="_showFachbereiche"
     * )
     */
    public function showFachbereicheAction() {
        // Alle Fachbereiche holen
        $fachbereiche = $this->getFachbereiche();

        return $this->render(
            'fachbereich/overview.html.twig',
            array('fachbereiche' => $fachbereiche)
        );
    }

    /**
     * @Route("/fachbereich/{fachbereichId}",
     *     name="_showFachbereich",
     *     requirements={"fachbereichId": "\d+"}
     * )
     */
    public function showFachbereichAction($fachbereichId) {
        // Fachbereich mit der Fachbereich_ID = $fachbereichId holen
        $fachbereich = $this->getFachbereich($fachbereichId);

        return $this->render(
            'fachbereich/detail.html.twig',
            array('fachbereich' => $fachbereich)
        );
    }

    /**
     * @Route("/fachbereich/neu",
     *     name="_neuFachbereich"
     * )
     */
    public function neuFachbereichAction(Request $request) {
        // Neuer Fachbereich
        $fachbereich = new Fachbereich();

        // Formular erstellen
        $form = $this->getFachbereichForm($fachbereich);
        $form->handleRequest($request);

        // Wurde das Formular abgesendet?
        if ($form->isSubmitted()) {

            // Ist das Forumlar valide?
            if($form->isValid()) {
                // Fachbereich in der DB anlegen
                $this->saveFachbereich($fachbereich);

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
            'fachbereich/form.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * @Route("/fachbereich/edit/{fachbereichId}",
     *     name="_editFachbereich"
     * )
     */
    public function editFachbereichAction(Request $request, $fachbereichId) {
        // Fachbereich mit der Fachbereich_ID = $fachbereichId holen
        $fachbereich = $this->getFachbereich($fachbereichId);

        // Formular erstellen
        $form = $this->getFachbereichForm($fachbereich);
        $form->handleRequest($request);

        // Wurde das Formular abgesendet?
        if ($form->isSubmitted()) {

            // Ist das Forumlar valide?
            if($form->isValid()) {
                // Fachbereich in der DB anlegen
                $this->saveFachbereich($fachbereich);

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
            'fachbereich/form-edit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * @Route("/fachbereich/delete/{fachbereichId}",
     *     name="_deleteFachbereich"
     * )
     */
    public function deleteFachbereichAction(Request $request, $fachbereichId) {
        // Fachbereich mit der Fachbereich_ID = $fachbereichId holen
        $fachbereich = $this->getFachbereich($fachbereichId);

        // Benachrichtigung: wirklich löschen?
        $this->addFlash(
            'delete',
            'Möchten Sie den Fachbereich wirklich löschen?'
        );

        return $this->render(
            'fachbereich/detail.html.twig',
            array('fachbereich' => $fachbereich)
        );
    }

    /**
     * @Route("/fachbereich/delete-confirm/{fachbereichId}",
     *     name="_deleteConfirmFachbereich"
     * )
     */
    public function deleteConfirmFachbereichAction(Request $request, $fachbereichId) {
        // Fachbereich mit der Fachbereich_ID = $fachbereichId holen
        $fachbereich = $this->getFachbereich($fachbereichId);

        // Fachbereich aus der DB entfernen
        $this->removeFachbereich($fachbereich);

        // Benachrichtigung: Fachbereich gelöscht
        $this->addFlash(
            'success',
            'Der Fachbereich wurde gelöscht.'
        );

        // URL für weiterleitung
        $url = $this->generateUrl("_showFachbereiche");
        return $this->redirect($url);
    }

    private function getFachbereiche() {
        $fachbereiche = $this->getDoctrine()
            ->getRepository('AppBundle:Fachbereich')
            ->findAll();

        return $fachbereiche;
    }

    private function getFachbereich($fachbereichId) {
        $fachbereich = $this->getDoctrine()
            ->getRepository('AppBundle:Fachbereich')
            ->find($fachbereichId);

        // Keinen Fachbereich gefunden
        if (!$fachbereich) {
            throw $this->createNotFoundException(
                'Kein Fachbereich mit der id ' . $fachbereichId
            );
        }

        return $fachbereich;
    }

    private function getFachbereichForm($fachbereich) {
        // Erzeugt ein Formular für das Objekt Fachbereich
        $form = $this->createFormBuilder($fachbereich)
            ->add('bezeichnung', TextType::class)
            ->add('speichern', SubmitType::class)
            ->getForm();

        return $form;
    }

    private function saveFachbereich($fachbereich) {
        $entityManager = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($fachbereich);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
    }

    private function removeFachbereich($fachbereich) {
        $entityManager = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) delete the Product (no queries yet)
        $entityManager->remove($fachbereich);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
    }
}