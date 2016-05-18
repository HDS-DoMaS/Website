<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Studiengaenge
 *
 * @ORM\Table(name="Studiengaenge", indexes={@ORM\Index(name="FK_Fachbereich_ID", columns={"Fachbereich_ID"})})
 * @ORM\Entity
 */
class Studiengaenge
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Fachbereich_ID", type="integer", nullable=false)
     */
    private $fachbereichId;

    /**
     * @var string
     *
     * @ORM\Column(name="Bezeichnung", type="string", length=40, nullable=false)
     */
    private $bezeichnung;

    /**
     * @var integer
     *
     * @ORM\Column(name="Studiengang_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $studiengangId;



    /**
     * Set fachbereichId
     *
     * @param integer $fachbereichId
     *
     * @return Studiengaenge
     */
    public function setFachbereichId($fachbereichId)
    {
        $this->fachbereichId = $fachbereichId;

        return $this;
    }

    /**
     * Get fachbereichId
     *
     * @return integer
     */
    public function getFachbereichId()
    {
        return $this->fachbereichId;
    }

    /**
     * Set bezeichnung
     *
     * @param string $bezeichnung
     *
     * @return Studiengaenge
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
     * Get studiengangId
     *
     * @return integer
     */
    public function getStudiengangId()
    {
        return $this->studiengangId;
    }
}
