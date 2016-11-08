<?php

namespace StoryBundle\Entity;

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
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User", mappedBy="id", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\OneToOne(targetEntity="StoryBundle\Entity\Story", mappedBy="id", cascade={"persist"})
     * @ORM\JoinColumn(name="story_id", referencedColumnName="id")
     */
    protected $story;

    /**
     * @ORM\OneToOne(targetEntity="StoryBundle\Entity\Progression", mappedBy="id", cascade={"persist"})
     * @ORM\JoinColumn(name="progression_id", referencedColumnName="id")
     */
    protected $progression;

}

