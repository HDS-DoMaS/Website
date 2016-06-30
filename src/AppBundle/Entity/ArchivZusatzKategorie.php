<?php

namespace AppBundle\Entity;

/**
 * ArchivZusatzKategorie
 */
class ArchivZusatzKategorie
{
    /**
     * @var string
     */
    private $bezeichnung;

    /**
     * @var boolean
     */
    private $istNM;

    /**
     * @var integer
     */
    private $archivZusatzKategorieId;

    /**
     * @var \AppBundle\Entity\ArchivZusatz
     */
    private $zusatz;


    /**
     * Set bezeichnung
     *
     * @param string $bezeichnung
     *
     * @return ArchivZusatzKategorie
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
     * Set istNM
     *
     * @param boolean $istNM
     *
     * @return ArchivZusatzKategorie
     */
    public function setIstNM($istNM)
    {
        $this->istNM = $istNM;

        return $this;
    }

    /**
     * Get istNM
     *
     * @return boolean
     */
    public function getIstNM()
    {
        return $this->istNM;
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
     * Set zusatz
     *
     * @param \AppBundle\Entity\ArchivZusatz $zusatz
     *
     * @return ArchivZusatzKategorie
     */
    public function setZusatz(\AppBundle\Entity\ArchivZusatz $zusatz = null)
    {
        $this->zusatz = $zusatz;

        return $this;
    }

    /**
     * Get zusatz
     *
     * @return \AppBundle\Entity\ArchivZusatz
     */
    public function getZusatz()
    {
        return $this->zusatz;
    }
}

