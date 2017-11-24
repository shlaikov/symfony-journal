<?php

namespace AppBundle\Entity;

use AppBundle\Utils\Translatable;
use Beelab\TagBundle\Tag\TaggableInterface;
use Beelab\TagBundle\Tag\TagInterface;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class News
 * @package AppBundle\Entity
 * @ORM\Table()
 * @ORM\Entity
 */
class News implements TaggableInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $alias;

    /**
     * @Assert\NotBlank()
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @ORM\Column(type="datetime", name="created_time")
     */
    private $createdTime;

    /**
     * @ORM\Column(type="datetime", name="edited_time", nullable=true)
     */
    private $editedTime;

    /**
     * @ORM\ManyToMany(targetEntity="Tag")
     */
    protected $tags;

    protected $tagsText;


    public function __construct()
    {
        $this->createdTime = new DateTime('now');
        $this->tags        = new ArrayCollection();
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function setTitle($title)
    {
        $this->alias = (new Translatable($title))->draw();
        $this->title = $title;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function addTag(TagInterface $tag)
    {
        $this->tags[] = $tag;
    }

    public function getTagNames()
    {
        return empty($this->tagsText) ? [] : array_map('trim', explode(',', $this->tagsText));
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function hasTag(TagInterface $tag)
    {
        return $this->tags->contains($tag);
    }

    public function removeTag(TagInterface $tag)
    {
        $this->tags->removeElement($tag);
    }

    public function setTagsText($tagsText)
    {
        $this->tagsText = $tagsText;
    }

    public function getTagsText()
    {
        $this->tagsText = implode(', ', $this->tags->toArray());

        return $this->tagsText;
    }
}