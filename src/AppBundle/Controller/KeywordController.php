<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\KeywordType;

class KeywordController extends Controller {
    /**
     * @Route("/keywords/{archivId}",
     *     name="_editKeywords",
     *     requirements={"archivId": "\d+"}
     * )
     */
    public function editKeywordsAction(Request $request, $archivId) {
        $archivierung = $this->getDoctrine()
            ->getRepository('AppBundle:Archivierung')
            ->find($archivId);

        // Ursprüngliche Keywords
        $originalKeywords = new ArrayCollection();
        foreach ($archivierung->getKeywords() as $keyword) {
            $originalKeywords->add($keyword);
        }

        $form = $this->createFormBuilder($archivierung)
            ->add('keywords', CollectionType::class, array(
                    'entry_type' => KeywordType::class,
                    'by_reference' => false,
                    'allow_add'    => true,
                    'allow_delete' => true,
                ))
            ->add('speichern', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            // entfernte Keywords löschen
            foreach ($originalKeywords as $keyword) {
                if (false === $archivierung->getKeywords()->contains($keyword)) {
                    $entityManager->remove($keyword);
                }
            }

            $entityManager->persist($archivierung);
            $entityManager->flush();
        }

        return $this->render(
            'keywords/form.html.twig',
            array('form' => $form->createView())
        );
    }
}