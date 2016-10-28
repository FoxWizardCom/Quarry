<?php

namespace StoryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use StoryBundle\Entity\StoryPart;

/**
 * Story
 *
 * @ORM\Table(name="story")
 * @ORM\Entity(repositoryClass="StoryBundle\Repository\StoryRepository")
 */
class Story extends StoryPart
{

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="StoryBundle\Entity\Chapter", mappedBy="story")
     */
    protected $chapters;


    public function __construct()
    {
        $this->chapters = new ArrayCollection();
    }

    public function __toString() {
        return $this->getTitle();
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Story
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getChapters()
    {
        return $this->chapters;
    }

    /**
     * @param mixed $chapters
     */
    public function setChapters($chapters)
    {
        $this->chapters = $chapters;
    }


    public function addChapter($chapter)
    {
        $this->chapters->add($chapter);
    }

}

