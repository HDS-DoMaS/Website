<?php

namespace AppBundle\Entity;

/**
 * Fachbereich
 */
class Fachbereich
{
    /**
     * @var string
     */
    private $bezeichnung;

    /**
     * @var integer
     */
    private $fachbereichId;

    /**
     * @var \AppBundle\Entity\Archivierung
     */
    private $archivierung;

    /**
     * @var \AppBundle\Entity\Studiengang
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

