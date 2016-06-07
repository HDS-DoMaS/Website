<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SuchController extends Controller {
    private $pageSize = 10;

    private $_queryBuilder;
    private $_zusatzMapper;

    /**
     * @Route("/suche",
     *     name="_suche"
     * )
     * @param $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sucheAction(Request $request) {
        // Doctrine QueryBuilder initialisieren
        $this->_queryBuilder = $this->getDoctrine()->getManager()->createQueryBuilder();

        // Post-Daten initialisieren
        $data = array();

        // Pagiation initialisieren
        $pagination = null;

        // Formular zusammenbauen
        $form = $this->getForm($data);

        // Wurde das Formular abgesendet?
        if ($request->isMethod('GET')) {
            // Formular bearbeitet Requestdaten
            $form->handleRequest($request);

            // Bei erfolgreicher Formularvalidierung
            if ($form->isValid()) {
                // Mapping zwischen ZusatzKategorieId : ZusatzKategorieBezeichung
                $this->_zusatzMapper = $this->get('app.zusatz_kategorie_mapper');

                // Postdaten auslesen
                $data = $form->getData();

                // SELECT Statment
                $this->_queryBuilder->select('archiv')
                    ->from('AppBundle\Entity\Archivierung', 'archiv') // Archivierung
                    ->leftJoin('archiv.fachbereich', 'fachbereich') // JOIN Fachbereich
                    ->leftJoin('archiv.studiengang', 'studiengang') // JOIN Studiengang
                    ->leftJoin('archiv.kategorie', 'kategorie') // JOIN Kategorie
                    ->leftJoin('archiv.benutzer', 'benutzer') // JOIN Benutzer
                    ->leftJoin('archiv.zusaetze', 'zusaetze') // JOIN Zusaetze
                    ->leftJoin('archiv.keywords', 'keywords'); // JOIN Keywords

                // WHERE Statement
                $this->handleWhereStatement($data);

                // Sucheanfrage abschicken & pagen
                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $this->_queryBuilder->getQuery(), // Zu Pagende Query
                    $request->query->getInt('page', 1), // Seiten Nummer
                    $this->pageSize, // Limit Pro Seite
                    array( // Optionen
                        'defaultSortFieldName' => 'archiv.titel', // Default Sortierung
                        'defaultSortDirection' => 'ASC',
                        'wrap-queries' => true // Sortieren über 2 Spalten
                    )
                );
            }
        }

        // View rendern
        return $this->render(
            'suche/index.html.twig',
            array(
                'pagination' => $pagination,
                'form' => $form->createView()
            )
        );
    }

    /**
     * Generiert das Suchformular
     * @param $data
     * @return \Symfony\Component\Form\Form
     */
    private function getForm($data) {
        return $this->createFormBuilder($data,
                array('csrf_protection' => false)
            )
            ->setMethod('GET')
            ->add('freitext', TextType::class)
            ->add('titel', TextType::class)
            ->add('benutzer', TextType::class)
            ->add('autor', TextType::class)
            ->add('fachbereich', TextType::class)
            ->add('studiengang', TextType::class)
            ->add('kategorie', TextType::class)
            ->add('abgabedatum', TextType::class)
            ->add('betreuer', TextType::class)
            ->add('unternehmen', TextType::class)
            ->add('versionsnummer', TextType::class)
            ->add('keywords', TextType::class)
            ->add('erstelldatum', TextType::class)
            ->add('hdncollapse', HiddenType::class, array('data' => 'collapsed'))
            ->add('submittop', SubmitType::class)
            ->add('submit', SubmitType::class)
            ->getForm();
    }

    /**
     * Setzt das WHERE Statement der Query
     * @param $data
     */
    private function handleWhereStatement($data) {
        // WHERE Freitext
        if(strlen($data['freitext']) > 0) {
            $this->setWhereFreitext($data['freitext']);
        }

        // WHERE Titel
        if(strlen($data['titel']) > 0) {
            $this->setWhere('archiv.titel', 'archiv_titel', $data['titel']);
        }

        // WHERE Autor
        if(strlen($data['autor']) > 0) {
            $this->setWhereZusatz('autor', $data['autor']);
        }

        // WHERE Fachbereich
        if(strlen($data['fachbereich']) > 0) {
            $this->setWhere('fachbereich.bezeichnung', 'fachbereich', $data['fachbereich']);
        }

        // WHERE Studiengang
        if(strlen($data['studiengang']) > 0) {
            $this->setWhere('studiengang.bezeichnung', 'studiengang', $data['studiengang']);
        }

        // WHERE Kategorie
        if(strlen($data['kategorie']) > 0) {
            $this->setWhere('kategorie.bezeichnung', 'kategorie', $data['kategorie']);
        }

        // WHERE Benutzer
        if(strlen($data['benutzer']) > 0) {
            $this->setWhere('CONCAT(benutzer.vorname, \' \', benutzer.nachname)', 'benutzer', $data['benutzer']);
        }

        // WHERE Betreuer
        if(strlen($data['betreuer']) > 0) {
            $this->setWhereZusatz('betreuer', $data['betreuer']);
        }

        // WHERE Unternehmen
        if(strlen($data['unternehmen']) > 0) {
            $this->setWhereZusatz('unternehmen', $data['unternehmen']);
        }

        // WHERE Keywords
        if(strlen($data['keywords']) > 0) {
            $this->setWhere('keywords.keyword', 'keywords', $data['keywords']);
        }

        // WHERE Abgabedatum
        if(strlen($data['abgabedatum']) > 0) {
            $this->setWhereDate('archiv.abgabedatum', 'abgabedatum', $data['abgabedatum']);
        }

        // WHERE Erstelldatum
        if(strlen($data['erstelldatum']) > 0) {
            $this->setWhereDate('archiv.erstelldatum', 'erstelldatum', $data['erstelldatum']);
        }
    }

    /**
     * Splittet den Freitext Suchbegriff bei Leerzeichen und setzt die WHERE-Clause
     * @param $search
     */
    private function setWhereFreitext($search) {
        // Bei ' ' splitten und suchen
        $search_array = explode(' ', $search);

        for ($i = 0; $i < count($search_array); $i++) {
            $this->_queryBuilder
                ->andWhere('
                    (
                        archiv.titel LIKE :freitext_' . $i . ' 
                        OR archiv.beschreibung LIKE :freitext_' . $i . '
                        OR archiv.abgabedatum LIKE :freitext_' . $i . '
                        OR archiv.anmerkung LIKE :freitext_' . $i . '
                        OR fachbereich.bezeichnung LIKE :freitext_' . $i . '
                        OR studiengang.bezeichnung LIKE :freitext_' . $i . '
                        OR kategorie.bezeichnung LIKE :freitext_' . $i . '
                        OR CONCAT(benutzer.vorname, \' \', benutzer.nachname) LIKE :freitext_' . $i . '
                        OR zusaetze.bezeichnung LIKE :freitext_' . $i . '
                        OR keywords.keyword LIKE :freitext_' . $i . '
                    )
                    OR MATCH(
                        archiv.titel, 
                        archiv.beschreibung,
                        archiv.anmerkung,
                        fachbereich.bezeichnung,
                        studiengang.bezeichnung,
                        kategorie.bezeichnung,
                        benutzer.vorname,
                        benutzer.nachname,
                        zusaetze.bezeichnung,
                        keywords.keyword
                    ) AGAINST (:freitext_match_' . $i . ' BOOLEAN) > 0.8
                ')
                ->setParameter('freitext_' . $i, '%' . $search_array[$i] . '%')
                ->setParameter('freitext_match_' . $i, '*' . $search_array[$i] . '*');
        }
    }

    /**
     * Setzt das WHERE Statement für normale Felder
     * @param $field
     * @param $var
     * @param $search
     */
    private function setWhere($field, $var, $search) {
        // Bei ' ' splitten und suchen
        $search_array = explode(' ', $search);

        for ($i = 0; $i < count($search_array); $i++) {
            $this->_queryBuilder
                ->andWhere($field .' LIKE :' . $var . '_' . $i . '
                OR MATCH (' . $field . ') AGAINST (:' . $var . '_match_' . $i . ' BOOLEAN) > 0.8')
                ->setParameter($var . '_' . $i, '%' . $search_array[$i] . '%')
                ->setParameter($var . '_match_' . $i, '*' . $search . '*');;
        }
    }

    /**
     * Setzt das WHERE Statement für Zusatz-Felder
     * @param $var
     * @param $search
     */
    private function setWhereZusatz($var, $search) {
        // Bei ' ' plitten und suchen
        $search_array = explode(' ', $search);

        for ($i = 0; $i < count($search_array); $i++) {

            $this->_queryBuilder
                ->andWhere('zusaetze.archivZusatzKategorieId = :' . $var . '_id 
                    AND (
                        zusaetze.bezeichnung LIKE :' . $var . '_' . $i . '
                        OR MATCH (zusaetze.bezeichnung) AGAINST (:' . $var . '_match_' . $i . ' BOOLEAN) > 0.8
                    )
                    ')
                ->setParameter($var . '_' . $i, '%' . $search . '%')
                ->setParameter($var . '_match_' . $i, '*' . $search . '*');

        }

        $this->_queryBuilder->setParameter($var . '_id', $this->_zusatzMapper->mapToId($var));
    }

    /**
     * Setzt das WHERE Statement für Datums Felder
     * @param $field
     * @param $var
     * @param $search
     */
    private function setWhereDate($field, $var, $search) {
        $seperator = strpos($search, 'bis');

        if ($seperator === false) {
            // Normale Suche
            $this->setWhere($field, $var, $search);
        } else {
            $von = trim(substr($search, 0, $seperator));
            $bis = trim(substr($search, $seperator + 3));

            if($this->isValidDate($von) && $this->isValidDate($bis)) {
                $this->_queryBuilder
                    ->andWhere($field . ' BETWEEN STR_TO_DATE(:' . $var . '_von, \'%d.%m.%Y\')  
                            AND STR_TO_DATE(:' . $var . '_bis, \'%d.%m.%Y\')')
                    ->setParameter($var . '_von', $von)
                    ->setParameter($var . '_bis', $bis);
            } else {
                // Normale Suche
                $this->setWhere($field, $var, $search);
            }
        }
    }

    /**
     * Prüft, ob es sich bei dem Parameter um ein gültiges Datum handelt
     * @param $datesting
     * @return bool
     */
    private function isValidDate($datesting) {
        $date = date_parse($datesting);
        return $date["error_count"] == 0 && checkdate($date["month"], $date["day"], $date["year"]);
    }
}