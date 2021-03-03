<?php

namespace App\EventListener;

use App\Repository\UserRepository;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\SerializerInterface;

class JWTCreatedListener {

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack, UserRepository $userRepository, SerializerInterface $serializer)
    {
        $this->requestStack = $requestStack;
        $this->userRepository = $userRepository;
        $this->serializer = $serializer;
    }

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $payload = $event->getData();
        $user = $this->userRepository->findByEmail($payload['username']);
        $payload['user'] = $this->serializer->normalize($user, null, ['groups' => ['user']]);

        $event->setData($payload);
    }
} 