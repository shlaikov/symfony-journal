<?php

namespace AppBundle\Entity;

use Beelab\TagBundle\Tag\TagInterface;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class Tag
 * @ORM\Table()
 * @ORM\Entity()
 */
class Tag implements TagInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $tagCreatedTime;

    public function __construct()
    {
        $this->tagCreatedTime = new DateTime('now');
    }

    public function __toString()
    {
        return (string) $this->name;
    }

    public function getId()
    {
        return (int) $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}