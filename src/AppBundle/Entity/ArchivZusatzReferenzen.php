<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArchivZusatzReferenzen
 *
 * @ORM\Table(name="Archiv_Zusatz_Referenzen", indexes={@ORM\Index(name="FK_Zusatz_ID", columns={"Archiv_Zusatz_ID"})})
 * @ORM\Entity
 */
class ArchivZusatzReferenzen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Archiv_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $archivId;

    /**
     * @var integer
     *
     * @ORM\Column(name="Archiv_Zusatz_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $archivZusatzId;



    /**
     * Set archivId
     *
     * @param integer $archivId
     *
     * @return ArchivZusatzReferenzen
     */
    public function setArchivId($archivId)
    {
        $this->archivId = $archivId;

        return $this;
    }

    /**
     * Get archivId
     *
     * @return integer
     */
    public function getArchivId()
    {
        return $this->archivId;
    }

    /**
     * Set archivZusatzId
     *
     * @param integer $archivZusatzId
     *
     * @return ArchivZusatzReferenzen
     */
    public function setArchivZusatzId($archivZusatzId)
    {
        $this->archivZusatzId = $archivZusatzId;

        return $this;
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
