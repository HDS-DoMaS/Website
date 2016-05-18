<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArchivKategorieFelder
 *
 * @ORM\Table(name="Archiv_Kategorie_Felder")
 * @ORM\Entity
 */
class ArchivKategorieFelder
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
     * Set default
     *
     * @param string $default
     *
     * @return ArchivKategorieFelder
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
     * @return ArchivKategorieFelder
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
     * @return ArchivKategorieFelder
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
}
