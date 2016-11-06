<?php

namespace StoryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use StoryBundle\Entity\Story as Story;
use Doctrine\ORM\Mapping as ORM;

/**
 * Chapter
 *
 * @ORM\Table(name="chapter")
 * @ORM\Entity(repositoryClass="StoryBundle\Repository\ChapterRepository")
 */
class Chapter extends StoryPart
{
    /**
     * @ORM\ManyToOne(targetEntity="Story", inversedBy="chapters")
     *
     */
    protected $story;

    /**
     * @ORM\OneToMany(targetEntity="StoryBundle\Entity\Mission", mappedBy="chapter", cascade={"persist"})
     */
    protected $missions;

    public function __construct()
    {
        $this->missions = new ArrayCollection();
    }

    public function __toString() {
        return $this->getTitle();
    }

    /**
     * @return mixed
     */
    public function getStory()
    {
        return $this->story;
    }

    /**
     * @param mixed $story
     */
    public function setStory(Story $story)
    {
        $this->story = $story;
    }

    /**
     * @return mixed
     */
    public function getMissions()
    {
        return $this->missions;
    }

    /**
     * @param mixed $missions
     */
    public function setMissions($missions)
    {
        $this->missions = $missions;
    }

    public function addStoryChild(StoryPart $storyPart)
    {
        $storyPart->setStoryParent($this);
        $this->missions->add($storyPart);
    }

    public function setStoryParent(StoryPart $storyPart)
    {
        $this->story = $storyPart;
    }

    public function removeStoryChild(StoryPart $storyPart)
    {
        $this->missions->removeElement($storyPart);
    }
}

