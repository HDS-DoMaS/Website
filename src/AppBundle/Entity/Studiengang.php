<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Studiengang
 *
 * @ORM\Table(name="Studiengaenge", indexes={@ORM\Index(name="FK_Fachbereich_ID", columns={"Fachbereich_ID"})})
 * @ORM\Entity
 */
class Studiengang
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
     * @var \AppBundle\Entity\Archivierung
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Archivierung", mappedBy="studiengang")
     */
    private $archivierung;

    /**
     * @var \AppBundle\Entity\Fachbereich
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Fachbereich", inversedBy="studiengang")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Fachbereich_ID", referencedColumnName="Fachbereich_ID", unique=true)
     * })
     */
    private $fachbereich;



    /**
     * Set fachbereichId
     *
     * @param integer $fachbereichId
     *
     * @return Studiengang
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
     * @return Studiengang
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

    /**
     * Set archivierung
     *
     * @param \AppBundle\Entity\Archivierung $archivierung
     *
     * @return Studiengang
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
     * Set fachbereich
     *
     * @param \AppBundle\Entity\Fachbereich $fachbereich
     *
     * @return Studiengang
     */
    public function setFachbereich(\AppBundle\Entity\Fachbereich $fachbereich = null)
    {
        $this->fachbereich = $fachbereich;

        return $this;
    }

    /**
     * Get fachbereich
     *
     * @return \AppBundle\Entity\Fachbereich
     */
    public function getFachbereich()
    {
        return $this->fachbereich;
    }
}
