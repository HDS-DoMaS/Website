<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ReferenzenType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;

class ReferenzenController extends Controller {
    /**
     * @Route("/referenzen/{archivId}",
     *     name="_editReferenzen",
     *     requirements={"archivId": "\d+"}
     * )
     */
    public function editKeywordsAction(Request $request, $archivId) {
        $archivierung = $this->getDoctrine()
            ->getRepository('AppBundle:Archivierung')
            ->find($archivId);

        $form = $this->createFormBuilder($archivierung)
            ->add('referenzen', CollectionType::class, array(
                    'entry_type' => ReferenzenType::class,
                    'by_reference' => false,
                    'allow_add'    => true,
                    'allow_delete' => true,
                ))
            ->add('speichern', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $archivRepos = $this->getDoctrine()->getRepository('AppBundle:Archivierung');
            $entityManager = $this->getDoctrine()->getManager();

            // Referenzen mit Werten aus DB überschreiben
            foreach ($archivierung->getReferenzen() as $referenz) {
                $archivierung->removeReferenzen($referenz);
                $archivierung->addReferenzen($archivRepos->find($referenz->getArchivId()));
            }

            $entityManager->persist($archivierung);
            $entityManager->flush();
        }

        return $this->render(
            'referenzen/form.html.twig',
            array(
                'form' => $form->createView(),
                'archivierungen' => $this->getDoctrine()->getRepository('AppBundle:Archivierung')->findAll()
            )
        );
    }
}