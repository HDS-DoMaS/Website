<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

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
     * @var string
     */
    private $eMail;

    /**
     * @var string
     */
    private $shibbolethUid; // z.B: dave1337

    /**
     * @var string
     */
    private $domasRole;

    /**
     * @var string
     */
    private $flag;

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
     * Set eMail
     *
     * @param string $eMail
     *
     * @return Benutzer
     */
    public function setEMail($eMail)
    {
        $this->eMail = $eMail;

        return $this;
    }

    /**
     * Get eMail
     *
     * @return string
     */
    public function getEMail()
    {
        return $this->eMail;
    }

    /**
     * Set shibbolethUid
     *
     * @param string $shibbolethUid
     *
     * @return Benutzer
     */
    public function setShibbolethUid($shibbolethUid)
    {
        $this->shibbolethUid = $shibbolethUid;

        return $this;
    }

    /**
     * Get shibbolethUid
     *
     * @return string
     */
    public function getShibbolethUid()
    {
        return $this->shibbolethUid;
    }

    /**
     * Set domasRole
     *
     * @param string $domasRole
     *
     * @return Benutzer
     */
    public function setDomasRole($domasRole)
    {
        $this->domasRole = $domasRole;

        return $this;
    }

    /**
     * Get domasRole
     *
     * @return string
     */
    public function getDomasRole()
    {
        return $this->domasRole;
    }

    /**
     * Set flag
     *
     * @param string flag
     *
     * @return Benutzer
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return string
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Get Username
     *
     * @return string
     */
    public function getUsername() {
        return $this->getVorname() . ' ' . $this->getNachname();
    }

    /**
     * ToString
     *
     * @return string
     */
    public function __toString() {
        return $this->getUsername();
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

