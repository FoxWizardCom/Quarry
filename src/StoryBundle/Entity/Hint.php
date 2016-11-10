<?php

namespace StoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hint
 *
 * @ORM\Table(name="hint")
 * @ORM\Entity(repositoryClass="StoryBundle\Repository\HintRepository")
 */
class Hint extends StoryPart
{
    /**
     * @ORM\ManyToOne(targetEntity="StoryBundle\Entity\Checkpoint", inversedBy="hints")
     */
    private $checkpoint;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="answer", type="string", length=255)
     */
    private $answer;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255)
     */
    private $message;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set question
     *
     * @param string $question
     *
     * @return Hint
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answer
     *
     * @param string $answer
     *
     * @return Hint
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Hint
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getCheckpoint()
    {
        return $this->checkpoint;
    }

    public function addStoryChild(StoryPart $storyPart)
    {
        // TODO: Implement addStoryPart() method.
    }

    public function setStoryParent(StoryPart $storyPart)
    {
        $this->checkpoint = $storyPart;
    }

    public function removeStoryChild(StoryPart $storyPart)
    {
        // TODO: Implement removeStoryChild() method.
    }
}

