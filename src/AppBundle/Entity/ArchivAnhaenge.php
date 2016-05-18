<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArchivAnhaenge
 *
 * @ORM\Table(name="Archiv_Anhaenge", indexes={@ORM\Index(name="FK_Archiv_ID", columns={"Archiv_ID"}), @ORM\Index(name="FK_Datei_Kategorie_ID", columns={"Datei_Kategorie_ID"})})
 * @ORM\Entity
 */
class ArchivAnhaenge
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Archiv_ID", type="integer", nullable=false)
     */
    private $archivId;

    /**
     * @var integer
     *
     * @ORM\Column(name="Datei_Kategorie_ID", type="integer", nullable=false)
     */
    private $dateiKategorieId;

    /**
     * @var string
     *
     * @ORM\Column(name="Pfad", type="string", length=80, nullable=false)
     */
    private $pfad;

    /**
     * @var string
     *
     * @ORM\Column(name="Versionsnummer", type="string", length=40, nullable=true)
     */
    private $versionsnummer;

    /**
     * @var integer
     *
     * @ORM\Column(name="Archiv_Anhang_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $archivAnhangId;



    /**
     * Set archivId
     *
     * @param integer $archivId
     *
     * @return ArchivAnhaenge
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
     * @return ArchivAnhaenge
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
     * @return ArchivAnhaenge
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
     * @return ArchivAnhaenge
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
}
