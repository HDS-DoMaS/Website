<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Keywords
 *
 * @ORM\Table(name="Keywords")
 * @ORM\Entity
 */
class Keywords
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
     * Set keyword
     *
     * @param string $keyword
     *
     * @return Keywords
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
}
