<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Benutzer
 *
 * @ORM\Table(name="benutzer", indexes={@ORM\Index(name="IDX_Archiv_Benutzer_Vorname_Fulltext", columns={"Vorname"}), @ORM\Index(name="IDX_Archiv_Benutzer_Nachname_Fulltext", columns={"Nachname"}), @ORM\Index(name="IDX_Archiv_Benutzer_Fulltext", columns={"Vorname", "Nachname"})})
 * @ORM\Entity
 */
class Benutzer
{
    /**
     * @var string
     *
     * @ORM\Column(name="Vorname", type="string", length=40, nullable=false)
     */
    private $vorname;

    /**
     * @var string
     *
     * @ORM\Column(name="Nachname", type="string", length=40, nullable=false)
     */
    private $nachname;

    /**
     * @var string
     *
     * @ORM\Column(name="E_Mail", type="string", length=255, nullable=true)
     */
    private $eMail;

    /**
     * @var string
     *
     * @ORM\Column(name="shibboleth_Uid", type="string", length=16, nullable=false)
     */
    private $shibbolethUid;

    /**
     * @var string
     *
     * @ORM\Column(name="domas_role", type="string", length=32, nullable=false)
     */
    private $domasRole;

    /**
     * @var integer
     *
     * @ORM\Column(name="Benutzer_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $benutzerId;



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
     * Get benutzerId
     *
     * @return integer
     */
    public function getBenutzerId()
    {
        return $this->benutzerId;
    }
}
