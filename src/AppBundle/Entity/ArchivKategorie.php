<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArchivKategorie
 *
 * @ORM\Table(name="Archiv_Kategorien")
 * @ORM\Entity
 */
class ArchivKategorie
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
     * @ORM\Column(name="Archiv_Kategorie_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $archivKategorieId;

    /**
     * @var \AppBundle\Entity\Archivierung
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Archivierung", mappedBy="kategorie")
     */
    private $archivierung;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ArchivKategorieFeld", mappedBy="archivKategorie")
     */
    private $felder;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->felder = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set bezeichnung
     *
     * @param string $bezeichnung
     *
     * @return ArchivKategorie
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
     * Get archivKategorieId
     *
     * @return integer
     */
    public function getArchivKategorieId()
    {
        return $this->archivKategorieId;
    }

    /**
     * Set archivierung
     *
     * @param \AppBundle\Entity\Archivierung $archivierung
     *
     * @return ArchivKategorie
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

    /**
     * Add felder
     *
     * @param \AppBundle\Entity\ArchivKategorieFeld $felder
     *
     * @return ArchivKategorie
     */
    public function addFelder(\AppBundle\Entity\ArchivKategorieFeld $felder)
    {
        $this->felder[] = $felder;

        return $this;
    }

    /**
     * Remove felder
     *
     * @param \AppBundle\Entity\ArchivKategorieFeld $felder
     */
    public function removeFelder(\AppBundle\Entity\ArchivKategorieFeld $felder)
    {
        $this->felder->removeElement($felder);
    }

    /**
     * Get felder
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFelder()
    {
        return $this->felder;
    }
}
