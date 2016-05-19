<?php

namespace AppBundle\Entity;

/**
 * Studiengang
 */
class Studiengang
{
    /**
     * @var integer
     */
    private $fachbereichId;

    /**
     * @var string
     */
    private $bezeichnung;

    /**
     * @var integer
     */
    private $studiengangId;

    /**
     * @var \AppBundle\Entity\Archivierung
     */
    private $archivierung;

    /**
     * @var \AppBundle\Entity\Fachbereich
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

