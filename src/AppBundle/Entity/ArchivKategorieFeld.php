<?php

namespace AppBundle\Entity;

/**
 * ArchivKategorieFeld
 */
class ArchivKategorieFeld
{
    /**
     * @var string
     */
    private $default;

    /**
     * @var integer
     */
    private $archivKategorieId;

    /**
     * @var string
     */
    private $feldname;

    /**
     * @var \AppBundle\Entity\ArchivKategorie
     */
    private $archivKategorie;


    /**
     * Set default
     *
     * @param string $default
     *
     * @return ArchivKategorieFeld
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Get default
     *
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Set archivKategorieId
     *
     * @param integer $archivKategorieId
     *
     * @return ArchivKategorieFeld
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
     * Set feldname
     *
     * @param string $feldname
     *
     * @return ArchivKategorieFeld
     */
    public function setFeldname($feldname)
    {
        $this->feldname = $feldname;

        return $this;
    }

    /**
     * Get feldname
     *
     * @return string
     */
    public function getFeldname()
    {
        return $this->feldname;
    }

    /**
     * Set archivKategorie
     *
     * @param \AppBundle\Entity\ArchivKategorie $archivKategorie
     *
     * @return ArchivKategorieFeld
     */
    public function setArchivKategorie(\AppBundle\Entity\ArchivKategorie $archivKategorie = null)
    {
        $this->archivKategorie = $archivKategorie;

        return $this;
    }

    /**
     * Get archivKategorie
     *
     * @return \AppBundle\Entity\ArchivKategorie
     */
    public function getArchivKategorie()
    {
        return $this->archivKategorie;
    }
}

