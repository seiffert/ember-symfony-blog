<?php

namespace Seiffert\Bundle\BlogApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @Serializer\ExclusionPolicy("all")
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     * @Serializer\Expose()
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $body;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Serializer\Expose()
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:sP'>")
     *
     * @var \DateTime
     */
    private $date;

    /**
     * @ORM\Column(type="string")
     *
     * @Serializer\Expose()
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $author;

    /**
     * @ORM\ManyToOne(
     *   targetEntity   = "BlogPost",
     *   inversedBy     = "comments"
     * )
     *
     * @var BlogPost
     */
    private $post;

    /**
     * @param string $author
     * @param string $body
     * @param \DateTime $date
     */
    public function __construct($author, $body, \DateTime $date)
    {
        $this->date = $date;
        $this->body = $body;
        $this->author = $author;
    }

    /**
     * @param BlogPost $post
     */
    public function setPost(BlogPost $post)
    {
        $this->post = $post;
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
    public function getAuthor()
    {
        return $this->author;
    }
}
