<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArchivAnhang
 *
 * @ORM\Table(name="Archiv_Anhaenge", indexes={@ORM\Index(name="FK_Archiv_ID", columns={"Archiv_ID"}), @ORM\Index(name="FK_Datei_Kategorie_ID", columns={"Datei_Kategorie_ID"})})
 * @ORM\Entity
 */
class ArchivAnhang
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
     * @var \AppBundle\Entity\DateiKategorie
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\DateiKategorie", inversedBy="archivAnhang")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Datei_Kategorie_ID", referencedColumnName="Datei_Kategorie_ID", unique=true)
     * })
     */
    private $dateiKategorie;

    /**
     * @var \AppBundle\Entity\Archivierung
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Archivierung", inversedBy="anhaenge")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Archiv_ID", referencedColumnName="Archiv_ID")
     * })
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
