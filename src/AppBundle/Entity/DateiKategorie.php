<?php

namespace AppBundle\Entity;

/**
 * DateiKategorie
 */
class DateiKategorie
{
    /**
     * @var string
     */
    private $bezeichnung;

    /**
     * @var integer
     */
    private $dateiKategorieId;

    /**
     * @var \AppBundle\Entity\ArchivAnhang
     */
    private $archivAnhang;


    /**
     * Set bezeichnung
     *
     * @param string $bezeichnung
     *
     * @return DateiKategorie
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
     * Set dateiKategorieId
     *
     * @param int $dateiKategorieId
     *
     * @return DateiKategorie
     */
    public function setDateiKategorieId($dateiKategorieId)
    {
        $this->dateiKategorieId = $dateiKategorieId;

        return $this;
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

    /**
     * Set archivAnhang
     *
     * @param \AppBundle\Entity\ArchivAnhang $archivAnhang
     *
     * @return DateiKategorie
     */
    public function setArchivAnhang(\AppBundle\Entity\ArchivAnhang $archivAnhang = null)
    {
        $this->archivAnhang = $archivAnhang;

        return $this;
    }

    /**
     * Get archivAnhang
     *
     * @return \AppBundle\Entity\ArchivAnhang
     */
    public function getArchivAnhang()
    {
        return $this->archivAnhang;
    }
}

