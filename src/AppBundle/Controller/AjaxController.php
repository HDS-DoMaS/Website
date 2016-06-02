<?php

namespace AppBundle\Controller;

use Doctrine\ORM\QueryBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class AjaxController extends Controller {
    /**
     * @Route("/ajax/zusatz/{kategorie}/{suche}")
     * @Route("/ajax/zusatz/{kategorie}")
     */
    public function requestZusatzAction($kategorie, $suche = null) {
        $queryBuilder = $this->getQueryBuilder();
        $zusatzMapper = $this->get('app.zusatz_kategorie_mapper');

        $queryBuilder
            ->select('zusaetze.archivZusatzId as id, zusaetze.bezeichnung as value')
            ->from('AppBundle\Entity\ArchivZusatz', 'zusaetze')
            ->andWhere('zusaetze.bezeichnung LIKE :bezeichnung')
            ->setParameter('bezeichnung', '%' . $suche . '%')
            ->andWhere('zusaetze.archivZusatzKategorieId = :zusatzKategorieId')
            ->setParameter('zusatzKategorieId', $zusatzMapper->mapToId($kategorie))
            ->orderBy('zusaetze.bezeichnung', 'ASC');

        return $this->returnJsonResponse($queryBuilder);
    }

    /**
     * @Route("/ajax/archiv/{feld}/{suche}")
     * @Route("/ajax/archiv/{feld}")
     */
    public function requestArchivTitelAction($feld, $suche = null) {
        $queryBuilder = $this->getQueryBuilder();

        $queryBuilder
            ->select('archiv.archivId as id, archiv.' . $feld . ' as value')
            ->from('AppBundle\Entity\Archivierung', 'archiv')
            ->andWhere('archiv.titel LIKE :suche')
            ->setParameter('suche', '%' . $suche . '%')
            ->orderBy('archiv.' . $feld, 'ASC');

        return $this->returnJsonResponse($queryBuilder);
    }

    /**
     * @Route("/ajax/benutzer/{name}")
     * @Route("/ajax/benutzer")
     */
    public function requestBenutzerAction($name = null) {
        $queryBuilder = $this->getQueryBuilder();

        $queryBuilder
            ->select('benutzer.benutzerId as id, CONCAT(benutzer.vorname, \' \', benutzer.nachname) as value')
            ->from('AppBundle\Entity\Benutzer', 'benutzer')
            ->andWhere('CONCAT(benutzer.vorname, \' \', benutzer.nachname) LIKE :name')
            ->setParameter('name', '%' . $name . '%')
            ->orderBy('benutzer.vorname, benutzer.nachname', 'ASC');

        return $this->returnJsonResponse($queryBuilder);
    }

    /**
     * @Route("/ajax/fachbereich/{bezeichnung}")
     * @Route("/ajax/fachbereich")
     */
    public function requestFachbereichAction($bezeichnung = null) {
        $queryBuilder = $this->getQueryBuilder();

        $queryBuilder
            ->select('fachbereich.fachbereichId as id, fachbereich.bezeichnung as value')
            ->from('AppBundle\Entity\Fachbereich', 'fachbereich')
            ->andWhere('fachbereich.bezeichnung LIKE :bezeichnung')
            ->setParameter('bezeichnung', '%' . $bezeichnung . '%')
            ->orderBy('fachbereich.bezeichnung', 'ASC');

        return $this->returnJsonResponse($queryBuilder);
    }

    /**
     * @Route("/ajax/studiengang/{bezeichnung}")
     * @Route("/ajax/studiengang")
     */
    public function requestStudiengangAction($bezeichnung = null) {
        $queryBuilder = $this->getQueryBuilder();

        $queryBuilder
            ->select('studiengang.studiengangId as id, studiengang.bezeichnung as value')
            ->from('AppBundle\Entity\Studiengang', 'studiengang')
            ->andWhere('studiengang.bezeichnung LIKE :bezeichnung')
            ->setParameter('bezeichnung', '%' . $bezeichnung . '%')
            ->orderBy('studiengang.bezeichnung', 'ASC');

        return $this->returnJsonResponse($queryBuilder);
    }

    /**
     * @Route("/ajax/kategorie/{bezeichnung}")
     * @Route("/ajax/kategorie")
     */
    public function requestKategorieAction($bezeichnung = null) {
        $queryBuilder = $this->getQueryBuilder();

        $queryBuilder
            ->select('archivKategorie.archivKategorieId as id, archivKategorie.bezeichnung as value')
            ->from('AppBundle\Entity\ArchivKategorie', 'archivKategorie')
            ->andWhere('archivKategorie.bezeichnung LIKE :bezeichnung')
            ->setParameter('bezeichnung', '%' . $bezeichnung . '%')
            ->orderBy('archivKategorie.bezeichnung', 'ASC');

        return $this->returnJsonResponse($queryBuilder);
    }

    /**
     * @Route("/ajax/keywords/{keyword}")
     * @Route("/ajax/keywords")
     */
    public function requestKeywordsAction($keyword = null) {
        $queryBuilder = $this->getQueryBuilder();

        $queryBuilder
            ->select('keyword.keywordId as id, keyword.keyword as value')
            ->from('AppBundle\Entity\Keyword', 'keyword')
            ->andWhere('keyword.keyword LIKE :keyword')
            ->setParameter('keyword', '%' . $keyword . '%')
            ->orderBy('keyword.keyword', 'ASC');

        return $this->returnJsonResponse($queryBuilder);
    }

    private function getQueryBuilder() {
        return $this->getDoctrine()->getManager()->createQueryBuilder();
    }

    private function returnJsonResponse(QueryBuilder $queryBuilder) {
        $array = $queryBuilder->setMaxResults(20)->getQuery()->getArrayResult();

        $response = new JsonResponse();
        $response->setData($array);

        return $response;
    }
}