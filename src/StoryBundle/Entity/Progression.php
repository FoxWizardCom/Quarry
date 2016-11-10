<?php

namespace StoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Progression
 *
 * @ORM\Table(name="progression")
 * @ORM\Entity(repositoryClass="StoryBundle\Repository\ProgressionRepository")
 */
class Progression
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Progression constructor.
     * @param $chapter
     * @param $mission
     * @param $checkpoint
     */
    public function __construct($chapter, $mission, $checkpoint)
    {
        $this->chapter = $chapter;
        $this->mission = $mission;
        $this->checkpoint = $checkpoint;
        $this->timeStarted = 0;
        $this->timeFinished = 0;
    }


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
     * @ORM\ManyToOne(targetEntity="StoryBundle\Entity\UserStory", inversedBy="progressions")
     */
    private $userStory;

    /**
    * @ORM\ManyToOne(targetEntity="StoryBundle\Entity\Chapter", cascade={"persist"})
    * @ORM\JoinColumn(name="chapter_id", referencedColumnName="id")
    */
    protected $chapter;

    /**
     * @ORM\ManyToOne(targetEntity="StoryBundle\Entity\Mission", cascade={"persist"})
     * @ORM\JoinColumn(name="mission_id", referencedColumnName="id")
     */
    protected $mission;

    /**
     * @return mixed
     */
    public function getUserStory()
    {
        return $this->userStory;
    }

    /**
     * @param mixed $userStory
     */
    public function setUserStory($userStory)
    {
        $this->userStory = $userStory;
    }

    /**
     * @ORM\ManyToOne(targetEntity="StoryBundle\Entity\Checkpoint", cascade={"persist"})
     * @ORM\JoinColumn(name="checkpoint_id", referencedColumnName="id")
     */
    protected $checkpoint;

    /**
     * @var int
     *
     * @ORM\Column(name="time_started", type="integer")
     */
    protected $timeStarted;

    /**
     * @var int
     *
     * @ORM\Column(name="time_finished", type="integer")
     */
    protected $timeFinished;

    /**
     * @return int
     */
    public function getTimeStarted()
    {
        return $this->timeStarted;
    }

    /**
     * @param int $timeStarted
     */
    public function setTimeStarted($timeStarted)
    {
        $this->timeStarted = $timeStarted;
    }

    /**
     * @return int
     */
    public function getTimeFinished()
    {
        return $this->timeFinished;
    }

    /**
     * @param int $timeFinished
     */
    public function setTimeFinished($timeFinished)
    {
        $this->timeFinished = $timeFinished;
    }



    /**
     * @return mixed
     */
    public function getChapter()
    {
        return $this->chapter;
    }

    /**
     * @param mixed $chapter
     */
    public function setChapter($chapter)
    {
        $this->chapter = $chapter;
    }

    /**
     * @return mixed
     */
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * @param mixed $mission
     */
    public function setMission($mission)
    {
        $this->mission = $mission;
    }

    /**
     * @return mixed
     */
    public function getCheckpoint()
    {
        return $this->checkpoint;
    }

    /**
     * @param mixed $checkpoint
     */
    public function setCheckpoint($checkpoint)
    {
        $this->checkpoint = $checkpoint;
    }



}

