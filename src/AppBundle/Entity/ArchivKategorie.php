<?php

namespace AppBundle\Entity;

/**
 * ArchivKategorie
 */
class ArchivKategorie
{
    /**
     * @var string
     */
    private $bezeichnung;

    /**
     * @var integer
     */
    private $archivKategorieId;

    /**
     * @var \AppBundle\Entity\Archivierung
     */
    private $archivierung;

    /**
     * @var \Doctrine\Common\Collections\Collection
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

