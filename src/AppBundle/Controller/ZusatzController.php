<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\ArchivZusatzType;

class ZusatzController extends Controller {
    /**
     * @Route("/zusaetze/{archivId}",
     *     name="_editZusaetze",
     *     requirements={"archivId": "\d+"}
     * )
     */
    public function editZusaetzeAction(Request $request, $archivId) {
        $archivierung = $this->getDoctrine()
            ->getRepository('AppBundle:Archivierung')
            ->find($archivId);

        // Ursprüngliche Zusatze
        $originalZusaetze = new ArrayCollection();
        foreach ($archivierung->getZusaetze() as $zusatz) {
            $originalZusaetze->add($zusatz);
        }

        $form = $this->createFormBuilder($archivierung)
            ->add('zusaetze', CollectionType::class, array(
                    'entry_type' => ArchivZusatzType::class,
                    'by_reference' => false,
                    'allow_add'    => true,
                    'allow_delete' => true,
                ))
            ->add('speichern', SubmitType::class)
            ->getForm();

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

            $entityManager->persist($archivierung);
            $entityManager->flush();
        }

        return $this->render(
            'zusaetze/form.html.twig',
            array('form' => $form->createView())
        );
    }
}