<?php

namespace AppBundle\Entity;

/**
 * Benutzer
 */
class Benutzer
{
    /**
     * @var string
     */
    private $vorname;

    /**
     * @var string
     */
    private $nachname;

    /**
     * @var integer
     */
    private $benutzerId;

    /**
     * @var \AppBundle\Entity\Archivierung
     */
    private $archivierung;


    /**
     * Set vorname
     *
     * @param string $vorname
     *
     * @return Benutzer
     */
    public function setVorname($vorname)
    {
        $this->vorname = $vorname;

        return $this;
    }

    /**
     * Get vorname
     *
     * @return string
     */
    public function getVorname()
    {
        return $this->vorname;
    }

    /**
     * Set nachname
     *
     * @param string $nachname
     *
     * @return Benutzer
     */
    public function setNachname($nachname)
    {
        $this->nachname = $nachname;

        return $this;
    }

    /**
     * Get nachname
     *
     * @return string
     */
    public function getNachname()
    {
        return $this->nachname;
    }

    /**
     * Get benutzerId
     *
     * @return integer
     */
    public function getBenutzerId()
    {
        return $this->benutzerId;
    }

    /**
     * Set archivierung
     *
     * @param \AppBundle\Entity\Archivierung $archivierung
     *
     * @return Benutzer
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
}

