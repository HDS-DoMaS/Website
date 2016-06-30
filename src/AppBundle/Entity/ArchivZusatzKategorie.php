<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArchivZusatzKategorie
 *
 * @ORM\Table(name="Archiv_Zusatz_Kategorien")
 * @ORM\Entity
 */
class ArchivZusatzKategorie
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
     * @var \AppBundle\Entity\ArchivZusatz
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\ArchivZusatz", mappedBy="zusatzKategorie")
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
