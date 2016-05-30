<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Studiengang;

class StudiengangController extends Controller {
    /**
     * @Route("/studiengaenge",
     *     name="_showStudiengaenge"
     * )
     */
    public function showStudiengaengeAction() {
        // Alle Studiengaenge holen
        $studiengaenge = $this->getStudiengaenge();

        return $this->render(
            'studiengang/overview.html.twig',
            array('studiengaenge' => $studiengaenge)
        );
    }

    /**
     * @Route("/studiengang/{studiengangId}",
     *     name="_showStudiengang",
     *     requirements={"studiengangId": "\d+"}
     * )
     */
    public function showStudiengangAction($studiengangId) {
        // Studiengang mit der Studiengang_ID = $studiengangId holen
        $studiengang = $this->getStudiengang($studiengangId);

        return $this->render(
            'studiengang/detail.html.twig',
            array('studiengang' => $studiengang)
        );
    }

    /**
     * @Route("/studiengang/neu",
     *     name="_neuStudiengang"
     * )
     */
    public function neuStudiengangAction(Request $request) {
        // Neuer Studiengang
        $studiengang = new Studiengang();

        // Formular erstellen
        $form = $this->getStudiengangForm($studiengang);
        $form->handleRequest($request);

        // Wurde das Formular abgesendet?
        if ($form->isSubmitted()) {

            // Ist das Forumlar valide?
            if($form->isValid()) {
                // Studiengang in der DB anlegen
                $this->saveStudiengang($studiengang);

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
            'studiengang/form.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * @Route("/studiengang/edit/{studiengangId}",
     *     name="_editStudiengang"
     * )
     */
    public function editStudiengangAction(Request $request, $studiengangId) {
        // Studiengang mit der Studiengang_ID = $studiengangId holen
        $studiengang = $this->getStudiengang($studiengangId);

        // Formular erstellen
        $form = $this->getStudiengangForm($studiengang);
        $form->handleRequest($request);

        // Wurde das Formular abgesendet?
        if ($form->isSubmitted()) {

            // Ist das Forumlar valide?
            if($form->isValid()) {
                // Studiengang in der DB anlegen
                $this->saveStudiengang($studiengang);

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
            'studiengang/form-edit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * @Route("/studiengang/delete/{studiengangId}",
     *     name="_deleteStudiengang"
     * )
     */
    public function deleteStudiengangAction(Request $request, $studiengangId) {
        // Studiengang mit der Studiengang_ID = $studiengangId holen
        $studiengang = $this->getStudiengang($studiengangId);

        // Benachrichtigung: wirklich löschen?
        $this->addFlash(
            'delete',
            'Möchten Sie den Studiengang wirklich löschen?'
        );

        return $this->render(
            'studiengang/detail.html.twig',
            array('studiengang' => $studiengang)
        );
    }

    /**
     * @Route("/studiengang/delete-confirm/{studiengangId}",
     *     name="_deleteConfirmStudiengang"
     * )
     */
    public function deleteConfirmStudiengangAction(Request $request, $studiengangId) {
        // Studiengang mit der Studiengang_ID = $studiengangId holen
        $studiengang = $this->getStudiengang($studiengangId);

        // Studiengang aus der DB entfernen
        $this->removeStudiengang($studiengang);

        // Benachrichtigung: Studiengang gelöscht
        $this->addFlash(
            'success',
            'Der Studiengang wurde gelöscht.'
        );

        // URL für weiterleitung
        $url = $this->generateUrl("_showStudiengaenge");
        return $this->redirect($url);
    }

    private function getStudiengaenge() {
        $studiengaenge = $this->getDoctrine()
            ->getRepository('AppBundle:Studiengang')
            ->findAll();

        return $studiengaenge;
    }

    private function getStudiengang($studiengangId) {
        $studiengang = $this->getDoctrine()
            ->getRepository('AppBundle:Studiengang')
            ->find($studiengangId);

        // Keinen Studiengang gefunden
        if (!$studiengang) {
            throw $this->createNotFoundException(
                'Kein Studiengang mit der id ' . $studiengangId
            );
        }

        return $studiengang;
    }

    private function getStudiengangForm($studiengang) {
        // Erzeugt ein Formular für das Objekt Studiengang
        $form = $this->createFormBuilder($studiengang)
            ->add('bezeichnung', TextType::class)
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
            ->add('speichern', SubmitType::class)
            ->getForm();

        return $form;
    }

    private function saveStudiengang($studiengang) {
        $entityManager = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($studiengang);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
    }

    private function removeStudiengang($studiengang) {
        $entityManager = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) delete the Product (no queries yet)
        $entityManager->remove($studiengang);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
    }
}