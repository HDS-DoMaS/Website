<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DateiKategorien
 *
 * @ORM\Table(name="Datei_Kategorien")
 * @ORM\Entity
 */
class DateiKategorien
{
    /**
     * @var string
     *
     * @ORM\Column(name="Bezeichnung", type="string", length=40, nullable=false)
     */
    private $bezeichnung;

    /**
     * @var integer
     *
     * @ORM\Column(name="Datei_Kategorie_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $dateiKategorieId;



    /**
     * Set bezeichnung
     *
     * @param string $bezeichnung
     *
     * @return DateiKategorien
     */
    public function setBezeichnung($bezeichnung)
    {
        $this->bezeichnung = $bezeichnung;

        return $this;
    }

    /**
     * Get bezeichnung
     *
     * @return string
     */
    public function getBezeichnung()
    {
        return $this->bezeichnung;
    }

    /**
     * Get dateiKategorieId
     *
     * @return integer
     */
    public function getDateiKategorieId()
    {
        return $this->dateiKategorieId;
    }
}
