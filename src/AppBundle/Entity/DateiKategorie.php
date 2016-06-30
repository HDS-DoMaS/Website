<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DateiKategorie
 *
 * @ORM\Table(name="Datei_Kategorien")
 * @ORM\Entity
 */
class DateiKategorie
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
     * @var \AppBundle\Entity\ArchivAnhang
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\ArchivAnhang", mappedBy="dateiKategorie")
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
