<?php

namespace StoryBundle\Entity;

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
     * @ORM\ManyToOne(targetEntity="StoryBundle\Entity\Story")
     */
    private $story;

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
    public function setStory($story)
    {
        $this->story = $story;
    }


}

