<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArchivReferenzen
 *
 * @ORM\Table(name="Archiv_Referenzen", indexes={@ORM\Index(name="FK_Kind_Archiv_ID", columns={"Kind_Archiv_ID"})})
 * @ORM\Entity
 */
class ArchivReferenzen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Eltern_Archiv_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $elternArchivId;

    /**
     * @var integer
     *
     * @ORM\Column(name="Kind_Archiv_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $kindArchivId;



    /**
     * Set elternArchivId
     *
     * @param integer $elternArchivId
     *
     * @return ArchivReferenzen
     */
    public function setElternArchivId($elternArchivId)
    {
        $this->elternArchivId = $elternArchivId;

        return $this;
    }

    /**
     * Get elternArchivId
     *
     * @return integer
     */
    public function getElternArchivId()
    {
        return $this->elternArchivId;
    }

    /**
     * Set kindArchivId
     *
     * @param integer $kindArchivId
     *
     * @return ArchivReferenzen
     */
    public function setKindArchivId($kindArchivId)
    {
        $this->kindArchivId = $kindArchivId;

        return $this;
    }

    /**
     * Get kindArchivId
     *
     * @return integer
     */
    public function getKindArchivId()
    {
        return $this->kindArchivId;
    }
}
