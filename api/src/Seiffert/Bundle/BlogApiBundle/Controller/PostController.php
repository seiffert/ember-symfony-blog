<?php

namespace Seiffert\Bundle\BlogApiBundle\Controller;

use Seiffert\Bundle\BlogApiBundle\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends Controller
{
    /**
     * @return array
     */
    public function listAction()
    {
        return [
            'post' => $this->getBlogPostRepository()->findAll()
        ];
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    private function getBlogPostRepository()
    {
        return $this->getDoctrine()->getRepository(BlogPost::class);
    }
}
