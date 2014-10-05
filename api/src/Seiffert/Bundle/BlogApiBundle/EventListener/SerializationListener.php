<?php

namespace Seiffert\Bundle\BlogApiBundle\EventListener;

use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

class SerializationListener
{
    /** @var SerializerInterface */
    private $serializer;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param GetResponseForControllerResultEvent $event
     */
    public function onView(GetResponseForControllerResultEvent $event)
    {
        $response = new Response($this->serializer->serialize($event->getControllerResult(), 'json'));

        $event->setResponse($response);
    }
}
