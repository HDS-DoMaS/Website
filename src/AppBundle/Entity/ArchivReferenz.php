<?php

namespace AppBundle\Entity;

/**
 * ArchivReferenz
 */
class ArchivReferenz
{
    /**
     * @var integer
     */
    private $elternArchivId;

    /**
     * @var integer
     */
    private $kindArchivId;


    /**
     * Set elternArchivId
     *
     * @param integer $elternArchivId
     *
     * @return ArchivReferenz
     */
    public function setElternArchivId($elternArchivId)
    {
        $this->elternArchivId = $elternArchivId;

        return $this;
    }

    /**
     * Get elternArchivId
     *
     * @return integer
     */
    public function getElternArchivId()
    {
        return $this->elternArchivId;
    }

    /**
     * Set kindArchivId
     *
     * @param integer $kindArchivId
     *
     * @return ArchivReferenz
     */
    public function setKindArchivId($kindArchivId)
    {
        $this->kindArchivId = $kindArchivId;

        return $this;
    }

    /**
     * Get kindArchivId
     *
     * @return integer
     */
    public function getKindArchivId()
    {
        return $this->kindArchivId;
    }
}

