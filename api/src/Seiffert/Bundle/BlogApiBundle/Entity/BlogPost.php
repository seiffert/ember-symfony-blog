<?php

namespace Seiffert\Bundle\BlogApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class BlogPost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     *
     * @var string
     */
    private $body;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $date;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $slug;

    /**
     * @ORM\OneToMany(
     *   targetEntity   = "Comment",
     *   mappedBy       = "post",
     *   cascade        = {"all"}
     * )
     *
     * @var ArrayCollection|Comment[]
     */
    private $comments;

    /**
     * @param string $title
     * @param string $slug
     * @param \DateTime $date
     * @param string $body
     */
    public function __construct($title, $slug, \DateTime $date, $body)
    {
        $this->title = $title;
        $this->slug = $slug;
        $this->date = $date;
        $this->body = $body;
        $this->comments = new ArrayCollection();
    }

    /**
     * @return Comment[]
     */
    public function getComments()
    {
        return $this->comments->toArray();
    }

    /**
     * @param string $author
     * @param string $body
     * @param \DateTime $date
     * @return Comment
     */
    public function addComment($author, $body, $date)
    {
        $comment = new Comment($author, $body, $date);
        $comment->setPost($this);
        $this->comments->add($comment);

        return $comment;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
