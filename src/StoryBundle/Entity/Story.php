<?php

namespace StoryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use StoryBundle\Entity\StoryPart;
use StoryBundle\StoryBundle;

/**
 * Story
 *
 * @ORM\Table(name="story")
 * @ORM\Entity(repositoryClass="StoryBundle\Repository\StoryRepository")
 */
class Story extends StoryPart
{

    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="stories")
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="Chapter", mappedBy="story", cascade={"persist"})
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

    public function addStoryChild(StoryPart $storyPart)
    {
        $this->chapters->add($storyPart);
    }

    public function setStoryParent(StoryPart $storyPart)
    {
        // TODO: Implement setStoryParent() method.
    }

    public function removeStoryChild(StoryPart $storyPart)
    {
       $this->chapters->removeElement($storyPart);
    }
}

