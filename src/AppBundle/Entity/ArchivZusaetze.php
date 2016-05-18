<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArchivZusaetze
 *
 * @ORM\Table(name="Archiv_Zusaetze", indexes={@ORM\Index(name="FK_Archiv_Zusatz_Kategorie_ID", columns={"Archiv_Zusatz_Kategorie_ID"})})
 * @ORM\Entity
 */
class ArchivZusaetze
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Archiv_Zusatz_Kategorie_ID", type="integer", nullable=false)
     */
    private $archivZusatzKategorieId;

    /**
     * @var string
     *
     * @ORM\Column(name="Bezeichnung", type="string", length=80, nullable=false)
     */
    private $bezeichnung;

    /**
     * @var string
     *
     * @ORM\Column(name="Matrikelnummer", type="string", length=10, nullable=true)
     */
    private $matrikelnummer;

    /**
     * @var integer
     *
     * @ORM\Column(name="Archiv_Zusatz_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $archivZusatzId;



    /**
     * Set archivZusatzKategorieId
     *
     * @param integer $archivZusatzKategorieId
     *
     * @return ArchivZusaetze
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
     * @return ArchivZusaetze
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
     * @return ArchivZusaetze
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
}
