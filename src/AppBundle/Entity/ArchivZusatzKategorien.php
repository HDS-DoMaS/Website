<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArchivZusatzKategorien
 *
 * @ORM\Table(name="Archiv_Zusatz_Kategorien")
 * @ORM\Entity
 */
class ArchivZusatzKategorien
{
    /**
     * @var string
     *
     * @ORM\Column(name="Bezeichnung", type="string", length=40, nullable=false)
     */
    private $bezeichnung;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Ist_n_m", type="boolean", nullable=false)
     */
    private $istNM;

    /**
     * @var integer
     *
     * @ORM\Column(name="Archiv_Zusatz_Kategorie_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $archivZusatzKategorieId;



    /**
     * Set bezeichnung
     *
     * @param string $bezeichnung
     *
     * @return ArchivZusatzKategorien
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
     * @return ArchivZusatzKategorien
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
}
