<?php

namespace AppBundle\Controller;

use Doctrine\ORM\QueryBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AjaxController extends Controller {
    private $pageSize = 10;
    private $pageSizeReferenzen = 10;

    /**
     * @Route("/archivierung/ajax/zusatz/{kategorie}/{suche}")
     * @Route("/archivierung/ajax/zusatz/{kategorie}/")
     */
    public function requestZusatzAction($kategorie, $suche = null) {
        $queryBuilder = $this->getQueryBuilder();
        $zusatzMapper = $this->get('app.zusatz_kategorie_mapper');

        $queryBuilder
            ->select('zusaetze.archivZusatzId as id, zusaetze.bezeichnung as value')
            ->from('AppBundle\Entity\ArchivZusatz', 'zusaetze')
            ->andWhere('zusaetze.archivZusatzKategorieId = :zusatzKategorieId')
            ->andWhere('zusaetze.bezeichnung LIKE :bezeichnung
                OR MATCH (zusaetze.bezeichnung) AGAINST (:match BOOLEAN) > 1')
            ->setParameter('bezeichnung', '%' . $suche . '%')
            ->setParameter('match', '*' . $suche . '*')
            ->setParameter('zusatzKategorieId', $zusatzMapper->mapToId($kategorie))
            ->groupBy('zusaetze.bezeichnung')
            ->orderBy('zusaetze.bezeichnung', 'ASC');

        return $this->returnJsonResponse($queryBuilder);
    }

    /**
     * @Route("/archivierung/ajax/archiv/{feld}/{suche}")
     * @Route("/archivierung/ajax/archiv/{feld}/")
     */
    public function requestArchivTitelAction($feld, $suche = null) {
        $queryBuilder = $this->getQueryBuilder();

        $queryBuilder
            ->select('archiv.archivId as id, archiv.' . $feld . ' as value')
            ->from('AppBundle\Entity\Archivierung', 'archiv')
            ->andWhere('archiv.titel LIKE :suche')
            ->orWhere('MATCH (archiv.titel) AGAINST (:match BOOLEAN) > 1')
            ->setParameter('suche', '%' . $suche . '%')
            ->setParameter('match', '*' . $suche . '*')
            ->groupBy('archiv.' . $feld)
            ->orderBy('archiv.' . $feld, 'ASC');

        return $this->returnJsonResponse($queryBuilder);
    }

    /**
     * @Route("/archivierung/ajax/benutzer/{name}")
     * @Route("/archivierung/ajax/benutzer/")
     */
    public function requestBenutzerAction($name = null) {
        $queryBuilder = $this->getQueryBuilder();

        $queryBuilder
            ->select('benutzer.benutzerId as id, CONCAT(benutzer.vorname, \' \', benutzer.nachname) as value')
            ->from('AppBundle\Entity\Benutzer', 'benutzer')
            ->andWhere('CONCAT(benutzer.vorname, \' \', benutzer.nachname) LIKE :name')
            ->orWhere('MATCH (benutzer.vorname, benutzer.nachname) AGAINST (:match BOOLEAN) > 1')
            ->setParameter('name', '%' . $name . '%')
            ->setParameter('match', '*' . $name . '*')
            ->groupBy('benutzer.vorname, benutzer.nachname')
            ->orderBy('benutzer.vorname, benutzer.nachname', 'ASC');

        return $this->returnJsonResponse($queryBuilder);
    }

    /**
     * @Route("/archivierung/ajax/fachbereich/{bezeichnung}")
     * @Route("/archivierung/ajax/fachbereich/")
     */
    public function requestFachbereichAction($bezeichnung = null) {
        $queryBuilder = $this->getQueryBuilder();

        $queryBuilder
            ->select('fachbereich.fachbereichId as id, fachbereich.bezeichnung as value')
            ->from('AppBundle\Entity\Fachbereich', 'fachbereich')
            ->andWhere('fachbereich.bezeichnung LIKE :bezeichnung')
            ->orWhere('MATCH (fachbereich.bezeichnung) AGAINST (:match BOOLEAN) > 1')
            ->setParameter('bezeichnung', '%' . $bezeichnung . '%')
            ->setParameter('match', '*' . $bezeichnung . '*')
            ->groupBy('fachbereich.bezeichnung')
            ->orderBy('fachbereich.bezeichnung', 'ASC');

        return $this->returnJsonResponse($queryBuilder);
    }

    /**
     * @Route("/archivierung/ajax/studiengang/{bezeichnung}")
     * @Route("/archivierung/ajax/studiengang/")
     */
    public function requestStudiengangAction($bezeichnung = null) {
        $queryBuilder = $this->getQueryBuilder();

        $queryBuilder
            ->select('studiengang.studiengangId as id, studiengang.bezeichnung as value')
            ->from('AppBundle\Entity\Studiengang', 'studiengang')
            ->andWhere('studiengang.bezeichnung LIKE :bezeichnung')
            ->orWhere('MATCH (studiengang.bezeichnung) AGAINST (:match BOOLEAN) > 1')
            ->setParameter('bezeichnung', '%' . $bezeichnung . '%')
            ->setParameter('match', '*' . $bezeichnung . '*')
            ->groupBy('studiengang.bezeichnung')
            ->orderBy('studiengang.bezeichnung', 'ASC');

        return $this->returnJsonResponse($queryBuilder);
    }

    /**
     * @Route("/archivierung/ajax/kategorie/{bezeichnung}")
     * @Route("/archivierung/ajax/kategorie/")
     */
    public function requestKategorieAction($bezeichnung = null) {
        $queryBuilder = $this->getQueryBuilder();

        $queryBuilder
            ->select('archivKategorie.archivKategorieId as id, archivKategorie.bezeichnung as value')
            ->from('AppBundle\Entity\ArchivKategorie', 'archivKategorie')
            ->andWhere('archivKategorie.bezeichnung LIKE :bezeichnung')
            ->orWhere('MATCH (archivKategorie.bezeichnung) AGAINST (:match BOOLEAN) > 1')
            ->setParameter('bezeichnung', '%' . $bezeichnung . '%')
            ->setParameter('match', '*' . $bezeichnung . '*')
            ->groupBy('archivKategorie.bezeichnung')
            ->orderBy('archivKategorie.bezeichnung', 'ASC');

        return $this->returnJsonResponse($queryBuilder);
    }

    /**
     * @Route("/archivierung/ajax/keywords/{keyword}")
     * @Route("/archivierung/ajax/keywords/")
     */
    public function requestKeywordsAction($keyword = null) {
        $queryBuilder = $this->getQueryBuilder();

        $queryBuilder
            ->select('keyword.keywordId as id, keyword.keyword as value')
            ->from('AppBundle\Entity\Keyword', 'keyword')
            ->andWhere('keyword.keyword LIKE :keyword')
            ->orWhere('MATCH (keyword.keyword) AGAINST (:match BOOLEAN) > 1')
            ->setParameter('keyword', '%' . $keyword . '%')
            ->setParameter('match', '*' . $keyword . '*')
            ->groupBy('keyword.keyword')
            ->orderBy('keyword.keyword', 'ASC');

        return $this->returnJsonResponse($queryBuilder);
    }

    private function getQueryBuilder() {
        return $this->getDoctrine()->getManager()->createQueryBuilder();
    }

    private function returnJsonResponse(QueryBuilder $queryBuilder) {
        $array = $queryBuilder->setMaxResults($this->pageSize)->getQuery()->getArrayResult();

        $response = new JsonResponse();
        $response->setData($array);

        return $response;
    }

    /**
     * @Route("/archivierung/ajax/suche-referenzen/{search}")
     * @Route("/archivierung/ajax/suche-referenzen/", name="_sucheReferenzen")
     */
    public function requestSuchReferenzAction(Request $request, $search = null) {
        $queryBuilder = $this->getQueryBuilder();

        $queryBuilder->select('archiv')
            ->from('AppBundle\Entity\Archivierung', 'archiv') // Archivierung
            ->leftJoin('archiv.fachbereich', 'fachbereich') // JOIN Fachbereich
            ->leftJoin('archiv.studiengang', 'studiengang') // JOIN Studiengang
            ->leftJoin('archiv.kategorie', 'kategorie') // JOIN Kategorie
            ->leftJoin('archiv.benutzer', 'benutzer') // JOIN Benutzer
            ->leftJoin('archiv.zusaetze', 'zusaetze') // JOIN Zusaetze
            ->leftJoin('archiv.keywords', 'keywords'); // JOIN Keywords

        // WHERE Statement
        $this->handleWhereStatement($queryBuilder, $search);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $queryBuilder->getQuery(), // Zu Pagende Query
            $request->query->getInt('page', 1), // Seiten Nummer
            $this->pageSizeReferenzen, // Limit Pro Seite
            array( // Optionen
                'defaultSortFieldName' => 'archiv.titel', // Default Sortierung
                'defaultSortDirection' => 'ASC',
                'wrap-queries' => true // Sortieren über 2 Spalten
            )
        );

        return $this->renderResponse($pagination);
    }

    /**
     * Setzt das WHERE Statement der Query
     * @param $data
     */
    private function handleWhereStatement($queryBuilder, $data) {
        // WHERE Freitext
        if(strlen($data) > 0) {
            $this->setWhereFreitext($queryBuilder, $data);
        }
    }

    /**
     * Splittet den Freitext Suchbegriff bei Leerzeichen und setzt die WHERE-Clause
     * @param $search
     */
    private function setWhereFreitext($queryBuilder, $search) {
        // Bei ' ' splitten und suchen
        $search_array = explode(' ', $search);

        for ($i = 0; $i < count($search_array); $i++) {
            $queryBuilder
                ->andWhere('
                    (
                        archiv.archivId LIKE :freitext_' . $i . ' 
                        OR archiv.titel LIKE :freitext_' . $i . ' 
                        OR archiv.beschreibung LIKE :freitext_' . $i . '
                        OR archiv.abgabedatum LIKE :freitext_' . $i . '
                        OR archiv.erstelldatum LIKE :freitext_' . $i . '
                        OR archiv.anmerkung LIKE :freitext_' . $i . '
                        OR fachbereich.bezeichnung LIKE :freitext_' . $i . '
                        OR studiengang.bezeichnung LIKE :freitext_' . $i . '
                        OR kategorie.bezeichnung LIKE :freitext_' . $i . '
                        OR CONCAT(benutzer.vorname, \' \', benutzer.nachname) LIKE :freitext_' . $i . '
                        OR zusaetze.bezeichnung LIKE :freitext_' . $i . '
                        OR keywords.keyword LIKE :freitext_' . $i . '
                    )
                    OR MATCH(
                        archiv.archivId,
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
                    ) AGAINST (:freitext_match_' . $i . ' BOOLEAN) > 1
                ')
                ->setParameter('freitext_' . $i, '%' . $search_array[$i] . '%')
                ->setParameter('freitext_match_' . $i, '*' . $search_array[$i] . '*');
        }
    }

    /**
     * @param $pagination
     * @return JsonResponse
     */
    private function renderResponse($pagination) {
        $items = array();

        foreach ($pagination as $archivierung) {
            $abgabedatum = $archivierung->getAbgabedatum();
            if($abgabedatum != null) {
                $abgabedatum = $abgabedatum->format('Y');
            } else {
                $abgabedatum = '';
            }

            $items[] = array(
                'archivId' => $archivierung->getArchivId(),
                'titel' => $archivierung->getTitel(),
                'fachbereich' => $archivierung->getFachbereich()->getBezeichnung(),
                'studiengang' => $archivierung->getStudiengang()->getBezeichnung(),
                'kategorie' => $archivierung->getKategorie()->getBezeichnung(),
                'abgabedatum' => $abgabedatum,
            );
        }

        $array = array(
            'page' => $pagination->getCurrentPageNumber(),
            'pageCount' => ceil($pagination->getTotalItemCount() / $this->pageSizeReferenzen),
            'totalCount' => $pagination->getTotalItemCount(),
            'items' => $items
        );

        /*
        dump($array);
        return $this->render(
            'base.html.twig'
        );
        */

        $response = new JsonResponse();
        $response->setData($array);

        return $response;
    }
}