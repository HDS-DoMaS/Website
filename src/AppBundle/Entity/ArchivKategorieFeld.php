<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArchivKategorieFeld
 *
 * @ORM\Table(name="Archiv_Kategorie_Felder")
 * @ORM\Entity
 */
class ArchivKategorieFeld
{
    /**
     * @var string
     *
     * @ORM\Column(name="Default", type="string", length=80, nullable=true)
     */
    private $default;

    /**
     * @var integer
     *
     * @ORM\Column(name="Archiv_Kategorie_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $archivKategorieId;

    /**
     * @var string
     *
     * @ORM\Column(name="Feldname", type="string", length=40)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $feldname;

    /**
     * @var \AppBundle\Entity\ArchivKategorie
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArchivKategorie", inversedBy="felder")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Archiv_Kategorie_ID", referencedColumnName="Archiv_Kategorie_ID")
     * })
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
