<?php

namespace Seiffert\Bundle\BlogApiBundle\Serialization;

use JMS\Serializer\Context;
use JMS\Serializer\JsonSerializationVisitor;
use Seiffert\Bundle\BlogApiBundle\Entity\BlogPost;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class BlogPostJsonSerializationHandler
{
    /** @var UrlGeneratorInterface */
    private $urlGenerator;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param JsonSerializationVisitor $visitor
     * @param BlogPost $post
     * @param array $type
     * @param Context $context
     * @return array
     */
    public function serializeBlogPostFromJson(
        JsonSerializationVisitor $visitor,
        BlogPost $post,
        array $type,
        Context $context
    ) {
        return [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'body' => $post->getBody(),
            'date' => $context->accept($post->getDate(), ['name' => 'DateTime']),
            'slug' => $post->getSlug(),
            'links' => [
                'comments' => $this->generateCommentsUrl($post)
            ]
        ];
    }

    /**
     * @param BlogPost $post
     * @return string
     */
    public function generateCommentsUrl(BlogPost $post)
    {
        return $this->urlGenerator->generate('comments', ['slug' => $post->getSlug()]);
    }
}
