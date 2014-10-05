<?php

namespace Seiffert\Bundle\BlogApiBundle\Controller;

use JMS\Serializer\SerializerInterface;
use Seiffert\Bundle\BlogApiBundle\Entity\BlogPost;
use Seiffert\Bundle\BlogApiBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * @param string $slug
     * @return Comment[]
     */
    public function listAction($slug)
    {
        $post = $this->getBlogPost($slug);

        return ['comment' => $post->getComments()];
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $blogPost = $this->getBlogPostById($data['comment']['post']);

        $comment = $blogPost->addComment($data['comment']['author'], $data['comment']['body'], new \DateTime());
        $this->getDoctrine()->getManager()->persist($blogPost);
        $this->getDoctrine()->getManager()->flush($blogPost);

        return new Response(
            $this->getSerializer()->serialize(['comment' => $comment], 'json'),
            201,
            ['Content-Type' => 'application/json']
        );
    }

    /**
     * @param int $id
     * @return Response
     */
    public function removeAction($id)
    {
        $comment = $this->getCommentById($id);

        $this->getDoctrine()->getManager()->remove($comment);
        $this->getDoctrine()->getManager()->flush();

        return new Response('', 200);
    }

    /**
     * @param string $slug
     * @return BlogPost
     */
    private function getBlogPost($slug)
    {
        $post = $this->getBlogPostRepository()->findOneBySlug($slug);

        if (null === $post) {
            throw $this->createNotFoundException();
        }

        return $post;
    }

    /**
     * @param int $id
     * @return BlogPost
     */
    private function getBlogPostById($id)
    {
        $post = $this->getBlogPostRepository()->find($id);

        if (null === $post) {
            throw $this->createNotFoundException();
        }

        return $post;
    }

    /**
     * @param int $id
     * @return Comment
     */
    private function getCommentById($id)
    {
        $comment = $this->getCommentRepository()->find($id);

        if (null === $comment) {
            throw $this->createNotFoundException();
        }

        return $comment;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    private function getBlogPostRepository()
    {
        return $this->getDoctrine()->getRepository(BlogPost::class);
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    private function getCommentRepository()
    {
        return $this->getDoctrine()->getRepository(Comment::class);
    }

    /**
     * @return SerializerInterface
     */
    private function getSerializer()
    {
        return $this->get('jms_serializer');
    }
}
