<?php

namespace AppBundle\Entity;

/**
 * ArchivZusatz
 */
class ArchivZusatz
{
    /**
     * @var integer
     */
    private $archivZusatzKategorieId;

    /**
     * @var string
     */
    private $bezeichnung;

    /**
     * @var string
     */
    private $matrikelnummer;

    /**
     * @var integer
     */
    private $archivZusatzId;

    /**
     * @var \AppBundle\Entity\ArchivZusatzKategorie
     */
    private $zusatzKategorie;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $archivierungen;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->archivierungen = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set archivZusatzKategorieId
     *
     * @param integer $archivZusatzKategorieId
     *
     * @return ArchivZusatz
     */
    public function setArchivZusatzKategorieId($archivZusatzKategorieId)
    {
        $this->archivZusatzKategorieId = $archivZusatzKategorieId;

        return $this;
    }

    /**
     * Get archivZusatzKategorieId
     *
     * @return integer
     */
    public function getArchivZusatzKategorieId()
    {
        return $this->archivZusatzKategorieId;
    }

    /**
     * Set bezeichnung
     *
     * @param string $bezeichnung
     *
     * @return ArchivZusatz
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
     * Set matrikelnummer
     *
     * @param string $matrikelnummer
     *
     * @return ArchivZusatz
     */
    public function setMatrikelnummer($matrikelnummer)
    {
        $this->matrikelnummer = $matrikelnummer;

        return $this;
    }

    /**
     * Get matrikelnummer
     *
     * @return string
     */
    public function getMatrikelnummer()
    {
        return $this->matrikelnummer;
    }

    /**
     * Get archivZusatzId
     *
     * @return integer
     */
    public function getArchivZusatzId()
    {
        return $this->archivZusatzId;
    }

    /**
     * Set zusatzKategorie
     *
     * @param \AppBundle\Entity\ArchivZusatzKategorie $zusatzKategorie
     *
     * @return ArchivZusatz
     */
    public function setZusatzKategorie(\AppBundle\Entity\ArchivZusatzKategorie $zusatzKategorie = null)
    {
        $this->zusatzKategorie = $zusatzKategorie;

        return $this;
    }

    /**
     * Get zusatzKategorie
     *
     * @return \AppBundle\Entity\ArchivZusatzKategorie
     */
    public function getZusatzKategorie()
    {
        return $this->zusatzKategorie;
    }

    /**
     * Add archivierungen
     *
     * @param \AppBundle\Entity\Archivierung $archivierungen
     *
     * @return ArchivZusatz
     */
    public function addArchivierungen(\AppBundle\Entity\Archivierung $archivierungen)
    {
        $this->archivierungen[] = $archivierungen;

        return $this;
    }

    /**
     * Remove archivierungen
     *
     * @param \AppBundle\Entity\Archivierung $archivierungen
     */
    public function removeArchivierungen(\AppBundle\Entity\Archivierung $archivierungen)
    {
        $this->archivierungen->removeElement($archivierungen);
    }

    /**
     * Get archivierungen
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArchivierungen()
    {
        return $this->archivierungen;
    }
}

