<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fachbereich
 *
 * @ORM\Table(name="Fachbereiche")
 * @ORM\Entity
 */
class Fachbereich
{
    /**
     * @var string
     *
     * @ORM\Column(name="Bezeichnung", type="string", length=40, nullable=false)
     */
    private $bezeichnung;

    /**
     * @var integer
     *
     * @ORM\Column(name="Fachbereich_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fachbereichId;

    /**
     * @var \AppBundle\Entity\Archivierung
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Archivierung", mappedBy="fachbereich")
     */
    private $archivierung;

    /**
     * @var \AppBundle\Entity\Studiengang
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Studiengang", mappedBy="fachbereich")
     */
    private $studiengang;



    /**
     * Set bezeichnung
     *
     * @param string $bezeichnung
     *
     * @return Fachbereich
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
     * Get fachbereichId
     *
     * @return integer
     */
    public function getFachbereichId()
    {
        return $this->fachbereichId;
    }

    /**
     * Set archivierung
     *
     * @param \AppBundle\Entity\Archivierung $archivierung
     *
     * @return Fachbereich
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
     * Set studiengang
     *
     * @param \AppBundle\Entity\Studiengang $studiengang
     *
     * @return Fachbereich
     */
    public function setStudiengang(\AppBundle\Entity\Studiengang $studiengang = null)
    {
        $this->studiengang = $studiengang;

        return $this;
    }

    /**
     * Get studiengang
     *
     * @return \AppBundle\Entity\Studiengang
     */
    public function getStudiengang()
    {
        return $this->studiengang;
    }
}
