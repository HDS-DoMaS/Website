<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArchivKategorieArchivZusatzKategorien
 *
 * @ORM\Table(name="Archiv_Kategorie_Archiv_Zusatz_Kategorien", indexes={@ORM\Index(name="FK_Archiv_Zusatz_Kategorie_ID", columns={"Archiv_Zusatz_Kategorie_ID"})})
 * @ORM\Entity
 */
class ArchivKategorieArchivZusatzKategorien
{
    /**
     * @var string
     *
     * @ORM\Column(name="Default", type="string", length=80, nullable=true)
     */
    private $default;

    /**
     * @var integer
     *
     * @ORM\Column(name="Archiv_Kategorie_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $archivKategorieId;

    /**
     * @var integer
     *
     * @ORM\Column(name="Archiv_Zusatz_Kategorie_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $archivZusatzKategorieId;



    /**
     * Set default
     *
     * @param string $default
     *
     * @return ArchivKategorieArchivZusatzKategorien
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Get default
     *
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Set archivKategorieId
     *
     * @param integer $archivKategorieId
     *
     * @return ArchivKategorieArchivZusatzKategorien
     */
    public function setArchivKategorieId($archivKategorieId)
    {
        $this->archivKategorieId = $archivKategorieId;

        return $this;
    }

    /**
     * Get archivKategorieId
     *
     * @return integer
     */
    public function getArchivKategorieId()
    {
        return $this->archivKategorieId;
    }

    /**
     * Set archivZusatzKategorieId
     *
     * @param integer $archivZusatzKategorieId
     *
     * @return ArchivKategorieArchivZusatzKategorien
     */
    public function setArchivZusatzKategorieId($archivZusatzKategorieId)
    {
        $this->archivZusatzKategorieId = $archivZusatzKategorieId;

        return $this;
    }

    /**
     * Get archivZusatzKategorieId
     *
     * @return integer
     */
    public function getArchivZusatzKategorieId()
    {
        return $this->archivZusatzKategorieId;
    }
}
