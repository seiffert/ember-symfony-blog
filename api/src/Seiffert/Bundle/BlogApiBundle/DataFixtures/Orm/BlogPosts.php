<?php

namespace Seiffert\Bundle\BlogApiBundle\DataFixtures\Orm;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\Persistence\ObjectManager;
use Seiffert\Bundle\BlogApiBundle\Entity\BlogPost;

class BlogPosts extends AbstractFixture
{
    /**
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $post = new BlogPost(
            'Tag 1',
            'first-post',
            new \DateTime(),
            'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.'
        );

        $post->addComment(
            'Paul Seiffert',
            'This is just awesome!',
            new \DateTime('+ 5min')
        );

        $post->addComment(
            'Paulee',
            'Really great!!',
            new \DateTime('+ 15min')
        );

        $post->addComment(
            'Peter',
            'Yeah!',
            new \DateTime('+ 17min')
        );
        $manager->persist($post);

        $post = new BlogPost(
            'Tag 2',
            'second-post',
            new \DateTime(),
            'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.'
        );

        $post->addComment(
            'Susan',
            'That is not my favorite blog.',
            new \DateTime('+ 5min')
        );

        $post->addComment(
            'Chris',
            'I don\'t like this post.',
            new \DateTime('+ 15min')
        );

        $post->addComment(
            'Paul',
            'Ich weiß echt nicht, warum hier manche auf Deutsch und manche auf Englisch schreiben.',
            new \DateTime('+ 17min')
        );

        $manager->persist($post);
        $manager->flush();
    }
}
