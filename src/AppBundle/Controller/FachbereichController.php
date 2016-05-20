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
        $fachbereiche = $this->getFachbereiche();

        if ($fachbereiche == null) {
            throw $this->createNotFoundException(
                'Keine Fachbereiche'
            );
        }

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
        $fachbereich = $this->getFachbereich($fachbereichId);

        if ($fachbereich == null) {
            throw $this->createNotFoundException(
                'Kein Fachbereich mit der id ' . $fachbereichId
            );
        }

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
        $fachbereich = new Fachbereich();

        $form = $this->getFachbereichForm($fachbereich);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            if($form->isValid()) {
                $this->saveFachbereich($fachbereich);
            } else {

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
        $fachbereich = $this->getFachbereich($fachbereichId);

        if (!$fachbereich) {
            throw $this->createNotFoundException(
                'Kein Fachbereich mit der id ' . $fachbereichId
            );
        }

        $form = $this->getFachbereichForm($fachbereich);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->saveFachbereich($fachbereich);

            $this->addFlash(
                'success',
                'Ihre Eingaben wurden erfolgreich gespeichert.'
            );
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
        $fachbereich = $this->getFachbereich($fachbereichId);

        if (!$fachbereich) {
            throw $this->createNotFoundException(
                'Kein Fachbereich mit der id ' . $fachbereichId
            );
        }

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
        $fachbereich = $this->getFachbereich($fachbereichId);

        if (!$fachbereich) {
            throw $this->createNotFoundException(
                'Kein Fachbereich mit der id ' . $fachbereichId
            );
        }

        $this->removeFachbereich($fachbereich);

        $this->addFlash(
            'success',
            'Der Fachbereich wurde gelöscht.'
        );


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

        return $fachbereich;
    }

    private function getFachbereichForm($fachbereich) {
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

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->remove($fachbereich);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
    }
}