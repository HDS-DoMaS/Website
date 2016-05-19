<?php

namespace AppBundle\Entity;

/**
 * ArchivKategorieArchivZusatzKategorien
 */
class ArchivKategorieArchivZusatzKategorien
{
    /**
     * @var string
     */
    private $default;

    /**
     * @var integer
     */
    private $archivKategorieId;

    /**
     * @var integer
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

