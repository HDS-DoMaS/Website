<?php

namespace AppBundle\Entity;

/**
 * Archivierung
 */
class Archivierung
{
    /**
     * @var integer
     */
    private $studiengangId;

    /**
     * @var integer
     */
    private $fachbereichId;

    /**
     * @var integer
     */
    private $benutzerId;

    /**
     * @var integer
     */
    private $archivKategorieId;

    /**
     * @var string
     */
    private $titel;

    /**
     * @var boolean
     */
    private $sichtbarkeit;

    /**
     * @var string
     */
    private $beschreibung;

    /**
     * @var \DateTime
     */
    private $abgabedatum;

    /**
     * @var \DateTime
     */
    private $erstelldatum;

    /**
     * @var string
     */
    private $anmerkung;

    /**
     * @var integer
     */
    private $archivId;

    /**
     * @var \AppBundle\Entity\Studiengang
     */
    private $studiengang;

    /**
     * @var \AppBundle\Entity\Fachbereich
     */
    private $fachbereich;

    /**
     * @var \AppBundle\Entity\Benutzer
     */
    private $benutzer;

    /**
     * @var \AppBundle\Entity\ArchivKategorie
     */
    private $kategorie;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $anhaenge;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $keywords;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $zusaetze;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $referenzen;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $referenziert;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->anhaenge = new \Doctrine\Common\Collections\ArrayCollection();
        $this->keywords = new \Doctrine\Common\Collections\ArrayCollection();
        $this->zusaetze = new \Doctrine\Common\Collections\ArrayCollection();
        $this->referenzen = new \Doctrine\Common\Collections\ArrayCollection();
        $this->referenziert = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set studiengangId
     *
     * @param integer $studiengangId
     *
     * @return Archivierung
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
     * @return Archivierung
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
     * @return Archivierung
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
     * @return Archivierung
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
     * @return Archivierung
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
     * @return Archivierung
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
     * @return Archivierung
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
     * @return Archivierung
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
     * @return Archivierung
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
     * @return Archivierung
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

    /**
     * Set studiengang
     *
     * @param \AppBundle\Entity\Studiengang $studiengang
     *
     * @return Archivierung
     */
    public function setStudiengang(\AppBundle\Entity\Studiengang $studiengang = null)
    {
        $this->studiengang = $studiengang;

        return $this;
    }

    /**
     * Get studiengang
     *
     * @return \AppBundle\Entity\Studiengang
     */
    public function getStudiengang()
    {
        return $this->studiengang;
    }

    /**
     * Set fachbereich
     *
     * @param \AppBundle\Entity\Fachbereich $fachbereich
     *
     * @return Archivierung
     */
    public function setFachbereich(\AppBundle\Entity\Fachbereich $fachbereich = null)
    {
        $this->fachbereich = $fachbereich;

        return $this;
    }

    /**
     * Get fachbereich
     *
     * @return \AppBundle\Entity\Fachbereich
     */
    public function getFachbereich()
    {
        return $this->fachbereich;
    }

    /**
     * Set benutzer
     *
     * @param \AppBundle\Entity\Benutzer $benutzer
     *
     * @return Archivierung
     */
    public function setBenutzer(\AppBundle\Entity\Benutzer $benutzer = null)
    {
        $this->benutzer = $benutzer;

        return $this;
    }

    /**
     * Get benutzer
     *
     * @return \AppBundle\Entity\Benutzer
     */
    public function getBenutzer()
    {
        return $this->benutzer;
    }

    /**
     * Set kategorie
     *
     * @param \AppBundle\Entity\ArchivKategorie $kategorie
     *
     * @return Archivierung
     */
    public function setKategorie(\AppBundle\Entity\ArchivKategorie $kategorie = null)
    {
        $this->kategorie = $kategorie;

        return $this;
    }

    /**
     * Get kategorie
     *
     * @return \AppBundle\Entity\ArchivKategorie
     */
    public function getKategorie()
    {
        return $this->kategorie;
    }

    /**
     * Add anhaenge
     *
     * @param \AppBundle\Entity\ArchivAnhang $anhaenge
     *
     * @return Archivierung
     */
    public function addAnhaenge(\AppBundle\Entity\ArchivAnhang $anhaenge)
    {
        $this->anhaenge[] = $anhaenge;

        return $this;
    }

    /**
     * Remove anhaenge
     *
     * @param \AppBundle\Entity\ArchivAnhang $anhaenge
     */
    public function removeAnhaenge(\AppBundle\Entity\ArchivAnhang $anhaenge)
    {
        $this->anhaenge->removeElement($anhaenge);
    }

    /**
     * Get anhaenge
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnhaenge()
    {
        return $this->anhaenge;
    }

    /**
     * Add keyword
     *
     * @param \AppBundle\Entity\Keyword $keyword
     *
     * @return Archivierung
     */
    public function addKeyword(\AppBundle\Entity\Keyword $keyword)
    {
        $this->keywords[] = $keyword;

        return $this;
    }

    /**
     * Remove keyword
     *
     * @param \AppBundle\Entity\Keyword $keyword
     */
    public function removeKeyword(\AppBundle\Entity\Keyword $keyword)
    {
        $this->keywords->removeElement($keyword);
    }

    /**
     * Get keywords
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Add zusaetze
     *
     * @param \AppBundle\Entity\ArchivZusatz $zusaetze
     *
     * @return Archivierung
     */
    public function addZusaetze(\AppBundle\Entity\ArchivZusatz $zusaetze)
    {
        $this->zusaetze[] = $zusaetze;

        return $this;
    }

    /**
     * Remove zusaetze
     *
     * @param \AppBundle\Entity\ArchivZusatz $zusaetze
     */
    public function removeZusaetze(\AppBundle\Entity\ArchivZusatz $zusaetze)
    {
        $this->zusaetze->removeElement($zusaetze);
    }

    /**
     * Get zusaetze
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getZusaetze()
    {
        return $this->zusaetze;
    }

    /**
     * Add referenzen
     *
     * @param \AppBundle\Entity\Archivierung $referenzen
     *
     * @return Archivierung
     */
    public function addReferenzen(\AppBundle\Entity\Archivierung $referenzen)
    {
        $this->referenzen[] = $referenzen;

        return $this;
    }

    /**
     * Remove referenzen
     *
     * @param \AppBundle\Entity\Archivierung $referenzen
     */
    public function removeReferenzen(\AppBundle\Entity\Archivierung $referenzen)
    {
        $this->referenzen->removeElement($referenzen);
    }

    /**
     * Get referenzen
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReferenzen()
    {
        return $this->referenzen;
    }

    /**
     * Add referenziert
     *
     * @param \AppBundle\Entity\Archivierung $referenziert
     *
     * @return Archivierung
     */
    public function addReferenziert(\AppBundle\Entity\Archivierung $referenziert)
    {
        $this->referenziert[] = $referenziert;

        return $this;
    }

    /**
     * Remove referenziert
     *
     * @param \AppBundle\Entity\Archivierung $referenziert
     */
    public function removeReferenziert(\AppBundle\Entity\Archivierung $referenziert)
    {
        $this->referenziert->removeElement($referenziert);
    }

    /**
     * Get referenziert
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReferenziert()
    {
        return $this->referenziert;
    }
}

