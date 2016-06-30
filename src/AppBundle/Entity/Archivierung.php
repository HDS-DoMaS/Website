<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Archivierung
 *
 * @ORM\Table(name="Archivierungen", indexes={@ORM\Index(name="FK_Studiengang_ID", columns={"Studiengang_ID"}), @ORM\Index(name="FK_Fachbereich_ID", columns={"Fachbereich_ID"}), @ORM\Index(name="FK_Benutzer_ID", columns={"Benutzer_ID"}), @ORM\Index(name="FK_Archiv_Kategorie_ID", columns={"Archiv_Kategorie_ID"})})
 * @ORM\Entity
 */
class Archivierung
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
     * @var \AppBundle\Entity\Studiengang
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Studiengang", inversedBy="archivierung")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Studiengang_ID", referencedColumnName="Studiengang_ID", unique=true)
     * })
     */
    private $studiengang;

    /**
     * @var \AppBundle\Entity\Fachbereich
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Fachbereich", inversedBy="archivierung")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Fachbereich_ID", referencedColumnName="Fachbereich_ID", unique=true)
     * })
     */
    private $fachbereich;

    /**
     * @var \AppBundle\Entity\Benutzer
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Benutzer", inversedBy="archivierung")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Benutzer_ID", referencedColumnName="Benutzer_ID", unique=true)
     * })
     */
    private $benutzer;

    /**
     * @var \AppBundle\Entity\ArchivKategorie
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\ArchivKategorie", inversedBy="archivierung")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Archiv_Kategorie_ID", referencedColumnName="Archiv_Kategorie_ID", unique=true)
     * })
     */
    private $kategorie;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ArchivAnhang", mappedBy="archivierung")
     */
    private $anhaenge;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Keyword", inversedBy="archivierungen", cascade={"persist"})
     * @ORM\JoinTable(name="Archiv_Keywords",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Archiv_ID", referencedColumnName="Archiv_ID")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Keyword_ID", referencedColumnName="Keyword_ID")
     *   }
     * )
     */
    private $keywords;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\ArchivZusatz", inversedBy="archivierungen", cascade={"persist"})
     * @ORM\JoinTable(name="Archiv_Zusatz_Referenzen",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Archiv_ID", referencedColumnName="Archiv_ID")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Archiv_Zusatz_ID", referencedColumnName="Archiv_Zusatz_ID")
     *   }
     * )
     */
    private $zusaetze;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Archivierung", inversedBy="referenziert", cascade={"persist"})
     * @ORM\JoinTable(name="Archiv_Referenzen",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Eltern_Archiv_ID", referencedColumnName="Archiv_ID")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Kind_Archiv_ID", referencedColumnName="Archiv_ID")
     *   }
     * )
     */
    private $referenzen;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Archivierung", mappedBy="referenzen")
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
