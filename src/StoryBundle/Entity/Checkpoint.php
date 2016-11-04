<?php

namespace StoryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Checkpoint
 *
 * @ORM\Table(name="checkpoint")
 * @ORM\Entity(repositoryClass="StoryBundle\Repository\CheckpointRepository")
 */
class Checkpoint extends StoryPart
{
    /**
     * @ORM\ManyToOne(targetEntity="StoryBundle\Entity\Mission")
     */
    private $mission;

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
     * @ORM\OneToMany(targetEntity="StoryBundle\Entity\Hint", mappedBy="checkpoint", cascade={"persist"})
     */
    protected $hints;

    public function __construct()
    {
        $this->hints = new ArrayCollection();
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
     * @return Checkpoint
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
     * @return Checkpoint
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
     * @return Checkpoint
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;

        return $this;
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
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * @return mixed
     */
    public function getHints()
    {
        return $this->hints;
    }

    /**
     * @param mixed $hints
     */
    public function setHints($hints)
    {
        $this->hints = $hints;
    }


    public function addStoryChild(StoryPart $storyPart)
    {
        $this->hints->add($storyPart);
    }

    public function setStoryParent(StoryPart $storyPart)
    {
        $this-> mission = $storyPart;
    }

    public function removeStoryChild(StoryPart $storyPart)
    {
        $this->hints->removeElement($storyPart);
    }
}

