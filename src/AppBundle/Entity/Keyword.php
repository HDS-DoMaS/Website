<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Keyword
 *
 * @ORM\Table(name="Keywords")
 * @ORM\Entity
 */
class Keyword
{
    /**
     * @var string
     *
     * @ORM\Column(name="Keyword", type="string", length=40, nullable=false)
     */
    private $keyword;

    /**
     * @var integer
     *
     * @ORM\Column(name="Keyword_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $keywordId;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Archivierung", mappedBy="keywords")
     */
    private $archivierungen;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->archivierungen = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set keyword
     *
     * @param string $keyword
     *
     * @return Keyword
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Get keywordId
     *
     * @return integer
     */
    public function getKeywordId()
    {
        return $this->keywordId;
    }

    /**
     * Add archivierungen
     *
     * @param \AppBundle\Entity\Archivierung $archivierungen
     *
     * @return Keyword
     */
    public function addArchivierungen(\AppBundle\Entity\Archivierung $archivierungen)
    {
        $this->archivierungen[] = $archivierungen;

        return $this;
    }

    /**
     * Remove archivierungen
     *
     * @param \AppBundle\Entity\Archivierung $archivierungen
     */
    public function removeArchivierungen(\AppBundle\Entity\Archivierung $archivierungen)
    {
        $this->archivierungen->removeElement($archivierungen);
    }

    /**
     * Get archivierungen
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArchivierungen()
    {
        return $this->archivierungen;
    }
}
