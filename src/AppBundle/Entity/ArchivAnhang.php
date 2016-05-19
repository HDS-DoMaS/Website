<?php

namespace AppBundle\Entity;

/**
 * ArchivAnhang
 */
class ArchivAnhang
{
    /**
     * @var integer
     */
    private $archivId;

    /**
     * @var integer
     */
    private $dateiKategorieId;

    /**
     * @var string
     */
    private $pfad;

    /**
     * @var string
     */
    private $versionsnummer;

    /**
     * @var integer
     */
    private $archivAnhangId;

    /**
     * @var \AppBundle\Entity\DateiKategorie
     */
    private $dateiKategorie;

    /**
     * @var \AppBundle\Entity\Archivierung
     */
    private $archivierung;


    /**
     * Set archivId
     *
     * @param integer $archivId
     *
     * @return ArchivAnhang
     */
    public function setArchivId($archivId)
    {
        $this->archivId = $archivId;

        return $this;
    }

    /**
     * Get archivId
     *
     * @return integer
     */
    public function getArchivId()
    {
        return $this->archivId;
    }

    /**
     * Set dateiKategorieId
     *
     * @param integer $dateiKategorieId
     *
     * @return ArchivAnhang
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
     * Set pfad
     *
     * @param string $pfad
     *
     * @return ArchivAnhang
     */
    public function setPfad($pfad)
    {
        $this->pfad = $pfad;

        return $this;
    }

    /**
     * Get pfad
     *
     * @return string
     */
    public function getPfad()
    {
        return $this->pfad;
    }

    /**
     * Set versionsnummer
     *
     * @param string $versionsnummer
     *
     * @return ArchivAnhang
     */
    public function setVersionsnummer($versionsnummer)
    {
        $this->versionsnummer = $versionsnummer;

        return $this;
    }

    /**
     * Get versionsnummer
     *
     * @return string
     */
    public function getVersionsnummer()
    {
        return $this->versionsnummer;
    }

    /**
     * Get archivAnhangId
     *
     * @return integer
     */
    public function getArchivAnhangId()
    {
        return $this->archivAnhangId;
    }

    /**
     * Set dateiKategorie
     *
     * @param \AppBundle\Entity\DateiKategorie $dateiKategorie
     *
     * @return ArchivAnhang
     */
    public function setDateiKategorie(\AppBundle\Entity\DateiKategorie $dateiKategorie = null)
    {
        $this->dateiKategorie = $dateiKategorie;

        return $this;
    }

    /**
     * Get dateiKategorie
     *
     * @return \AppBundle\Entity\DateiKategorie
     */
    public function getDateiKategorie()
    {
        return $this->dateiKategorie;
    }

    /**
     * Set archivierung
     *
     * @param \AppBundle\Entity\Archivierung $archivierung
     *
     * @return ArchivAnhang
     */
    public function setArchivierung(\AppBundle\Entity\Archivierung $archivierung = null)
    {
        $this->archivierung = $archivierung;

        return $this;
    }

    /**
     * Get archivierung
     *
     * @return \AppBundle\Entity\Archivierung
     */
    public function getArchivierung()
    {
        return $this->archivierung;
    }
}

