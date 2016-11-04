<?php

namespace StoryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Mission
 *
 * @ORM\Table(name="mission")
 * @ORM\Entity(repositoryClass="StoryBundle\Repository\MissionRepository")
 */
class Mission extends StoryPart
{

    /**
     * @ORM\ManyToOne(targetEntity="StoryBundle\Entity\Chapter")
     */
    private $chapter;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;

    /**
     * @var int
     *
     * @ORM\Column(name="radius", type="integer")
     */
    private $radius;

    /**
     * @ORM\OneToMany(targetEntity="StoryBundle\Entity\Checkpoint", mappedBy="Mission", cascade={"persist"})
     */
    protected $checkpoints;

    public function __construct()
    {
        $this->checkpoints = new ArrayCollection();
    }

    public function __toString() {
        return $this->getTitle();
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
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Mission
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Mission
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set radius
     *
     * @param integer $radius
     *
     * @return Mission
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getChapter()
    {
        return $this->chapter;
    }


    /**
     * Get radius
     *
     * @return int
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * @return mixed
     */
    public function getCheckpoints()
    {
        return $this->checkpoints;
    }

    /**
     * @param mixed $checkpoints
     */
    public function setCheckpoints($checkpoints)
    {
        $this->checkpoints = $checkpoints;
    }


    public function addStoryChild(StoryPart $storyPart)
    {
        $this->checkpoints->add($storyPart);
    }

    public function setStoryParent(StoryPart $storyPart)
    {
        $this->chapter = $storyPart;
    }

    public function removeStoryChild(StoryPart $storyPart)
    {
        $this->checkpoints->removeElement($storyPart);
    }
}

