<?php
namespace AppBundle\Helper;

use AppBundle\Entity\ArchivZusatzKategorie;
use Doctrine\ORM\Query;

class ZusatzKategorieHelper {
    private $idZuKategorie = array();
    private $kategorieZuId = array();

    public function __construct($doctrine) {
        $zusatzKategorien = $doctrine
            ->getRepository('AppBundle:ArchivZusatzKategorie')
            ->findAll();

        foreach($zusatzKategorien as $zusatzKategorie) {
            $this->idZuKategorie[$zusatzKategorie->getArchivZusatzKategorieId()] = strtolower($zusatzKategorie->getBezeichnung());
            $this->kategorieZuId[strtolower($zusatzKategorie->getBezeichnung())] = $zusatzKategorie->getArchivZusatzKategorieId();
        }
    }

    public function mapToKategorie($id) {
        return $this->idZuKategorie[$id];
    }

    public function mapToId($bezeichnung) {
        return $this->kategorieZuId[strtolower($bezeichnung)];
    }
}