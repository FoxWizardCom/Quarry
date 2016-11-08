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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
    * @ORM\OneToOne(targetEntity="StoryBundle\Entity\Chapter", mappedBy="id", cascade={"persist"})
    * @ORM\JoinColumn(name="chapter_id", referencedColumnName="id")
    */
    protected $chapter;

    /**
     * @ORM\OneToOne(targetEntity="StoryBundle\Entity\Mission", mappedBy="id", cascade={"persist"})
     * @ORM\JoinColumn(name="mission_id", referencedColumnName="id")
     */
    protected $mission;

    /**
     * @ORM\OneToOne(targetEntity="StoryBundle\Entity\Checkpoint", mappedBy="id", cascade={"persist"})
     * @ORM\JoinColumn(name="checkpoint_id", referencedColumnName="id")
     */
    protected $checkpoint;

    /**
     * @ORM\OneToOne(targetEntity="StoryBundle\Entity\Hint", mappedBy="hint", cascade={"persist"})
     * @ORM\JoinColumn(name="hint_id", referencedColumnName="id")
     */
    protected $hint;

    protected $time;

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

    /**
     * @return mixed
     */
    public function getHint()
    {
        return $this->hint;
    }

    /**
     * @param mixed $hint
     */
    public function setHint($hint)
    {
        $this->hint = $hint;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }
}

