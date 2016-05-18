<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArchivKeywords
 *
 * @ORM\Table(name="Archiv_Keywords", indexes={@ORM\Index(name="FK_Keyword_ID", columns={"Keyword_ID"})})
 * @ORM\Entity
 */
class ArchivKeywords
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Archiv_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $archivId;

    /**
     * @var integer
     *
     * @ORM\Column(name="Keyword_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $keywordId;



    /**
     * Set archivId
     *
     * @param integer $archivId
     *
     * @return ArchivKeywords
     */
    public function setArchivId($archivId)
    {
        $this->archivId = $archivId;

        return $this;
    }

    /**
     * Get archivId
     *
     * @return integer
     */
    public function getArchivId()
    {
        return $this->archivId;
    }

    /**
     * Set keywordId
     *
     * @param integer $keywordId
     *
     * @return ArchivKeywords
     */
    public function setKeywordId($keywordId)
    {
        $this->keywordId = $keywordId;

        return $this;
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
}
