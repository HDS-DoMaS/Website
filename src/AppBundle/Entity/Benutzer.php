<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Benutzer
 *
 * @ORM\Table(name="Benutzer")
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
     * Get benutzerId
     *
     * @return integer
     */
    public function getBenutzerId()
    {
        return $this->benutzerId;
    }
}
