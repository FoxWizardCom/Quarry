<?php

namespace StoryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * UserStory
 *
 * @ORM\Table(name="user_story")
 * @ORM\Entity(repositoryClass="StoryBundle\Repository\UserStoryRepository")
 */
class UserStory
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
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="StoryBundle\Entity\Story", cascade={"persist"})
     * @ORM\JoinColumn(name="story_id", referencedColumnName="id")
     */
    protected $story;

    /**
     * @return mixed
     */
    public function getProgressions()
    {
        return $this->progressions;
    }

    /**
     * @param mixed $progressions
     */
    public function setProgressions($progressions)
    {
        $this->progressions = $progressions;
    }

    /**
     * @ORM\OneToMany(targetEntity="StoryBundle\Entity\Progression", mappedBy="userStory", cascade={"persist"})
     */
    protected $progressions;

    public function __construct()
    {
        $this->progressions = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
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
    public function setStory($story)
    {
        $this->story = $story;
    }

}

