<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Archivierungen
 *
 * @ORM\Table(name="Archivierungen", indexes={@ORM\Index(name="FK_Studiengang_ID", columns={"Studiengang_ID"}), @ORM\Index(name="FK_Fachbereich_ID", columns={"Fachbereich_ID"}), @ORM\Index(name="FK_Benutzer_ID", columns={"Benutzer_ID"}), @ORM\Index(name="FK_Archiv_Kategorie_ID", columns={"Archiv_Kategorie_ID"})})
 * @ORM\Entity
 */
class Archivierungen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Studiengang_ID", type="integer", nullable=false)
     */
    private $studiengangId;

    /**
     * @var integer
     *
     * @ORM\Column(name="Fachbereich_ID", type="integer", nullable=false)
     */
    private $fachbereichId;

    /**
     * @var integer
     *
     * @ORM\Column(name="Benutzer_ID", type="integer", nullable=false)
     */
    private $benutzerId;

    /**
     * @var integer
     *
     * @ORM\Column(name="Archiv_Kategorie_ID", type="integer", nullable=false)
     */
    private $archivKategorieId;

    /**
     * @var string
     *
     * @ORM\Column(name="Titel", type="string", length=255, nullable=false)
     */
    private $titel;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Sichtbarkeit", type="boolean", nullable=false)
     */
    private $sichtbarkeit;

    /**
     * @var string
     *
     * @ORM\Column(name="Beschreibung", type="string", length=1023, nullable=true)
     */
    private $beschreibung;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Abgabedatum", type="date", nullable=true)
     */
    private $abgabedatum;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Erstelldatum", type="date", nullable=false)
     */
    private $erstelldatum;

    /**
     * @var string
     *
     * @ORM\Column(name="Anmerkung", type="string", length=1023, nullable=true)
     */
    private $anmerkung;

    /**
     * @var integer
     *
     * @ORM\Column(name="Archiv_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $archivId;



    /**
     * Set studiengangId
     *
     * @param integer $studiengangId
     *
     * @return Archivierungen
     */
    public function setStudiengangId($studiengangId)
    {
        $this->studiengangId = $studiengangId;

        return $this;
    }

    /**
     * Get studiengangId
     *
     * @return integer
     */
    public function getStudiengangId()
    {
        return $this->studiengangId;
    }

    /**
     * Set fachbereichId
     *
     * @param integer $fachbereichId
     *
     * @return Archivierungen
     */
    public function setFachbereichId($fachbereichId)
    {
        $this->fachbereichId = $fachbereichId;

        return $this;
    }

    /**
     * Get fachbereichId
     *
     * @return integer
     */
    public function getFachbereichId()
    {
        return $this->fachbereichId;
    }

    /**
     * Set benutzerId
     *
     * @param integer $benutzerId
     *
     * @return Archivierungen
     */
    public function setBenutzerId($benutzerId)
    {
        $this->benutzerId = $benutzerId;

        return $this;
    }

    /**
     * Get benutzerId
     *
     * @return integer
     */
    public function getBenutzerId()
    {
        return $this->benutzerId;
    }

    /**
     * Set archivKategorieId
     *
     * @param integer $archivKategorieId
     *
     * @return Archivierungen
     */
    public function setArchivKategorieId($archivKategorieId)
    {
        $this->archivKategorieId = $archivKategorieId;

        return $this;
    }

    /**
     * Get archivKategorieId
     *
     * @return integer
     */
    public function getArchivKategorieId()
    {
        return $this->archivKategorieId;
    }

    /**
     * Set titel
     *
     * @param string $titel
     *
     * @return Archivierungen
     */
    public function setTitel($titel)
    {
        $this->titel = $titel;

        return $this;
    }

    /**
     * Get titel
     *
     * @return string
     */
    public function getTitel()
    {
        return $this->titel;
    }

    /**
     * Set sichtbarkeit
     *
     * @param boolean $sichtbarkeit
     *
     * @return Archivierungen
     */
    public function setSichtbarkeit($sichtbarkeit)
    {
        $this->sichtbarkeit = $sichtbarkeit;

        return $this;
    }

    /**
     * Get sichtbarkeit
     *
     * @return boolean
     */
    public function getSichtbarkeit()
    {
        return $this->sichtbarkeit;
    }

    /**
     * Set beschreibung
     *
     * @param string $beschreibung
     *
     * @return Archivierungen
     */
    public function setBeschreibung($beschreibung)
    {
        $this->beschreibung = $beschreibung;

        return $this;
    }

    /**
     * Get beschreibung
     *
     * @return string
     */
    public function getBeschreibung()
    {
        return $this->beschreibung;
    }

    /**
     * Set abgabedatum
     *
     * @param \DateTime $abgabedatum
     *
     * @return Archivierungen
     */
    public function setAbgabedatum($abgabedatum)
    {
        $this->abgabedatum = $abgabedatum;

        return $this;
    }

    /**
     * Get abgabedatum
     *
     * @return \DateTime
     */
    public function getAbgabedatum()
    {
        return $this->abgabedatum;
    }

    /**
     * Set erstelldatum
     *
     * @param \DateTime $erstelldatum
     *
     * @return Archivierungen
     */
    public function setErstelldatum($erstelldatum)
    {
        $this->erstelldatum = $erstelldatum;

        return $this;
    }

    /**
     * Get erstelldatum
     *
     * @return \DateTime
     */
    public function getErstelldatum()
    {
        return $this->erstelldatum;
    }

    /**
     * Set anmerkung
     *
     * @param string $anmerkung
     *
     * @return Archivierungen
     */
    public function setAnmerkung($anmerkung)
    {
        $this->anmerkung = $anmerkung;

        return $this;
    }

    /**
     * Get anmerkung
     *
     * @return string
     */
    public function getAnmerkung()
    {
        return $this->anmerkung;
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
}
