<?php

namespace App\Service\Manager;

use App\Entity\Topic;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class TopicManager
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly SerializerInterface $serializer
    )
    {}

    public function getTopicsByParentId(?int $parent): array
    {
        $result = [];
        $topics = $this->entityManager->getRepository(Topic::class)->findBy(['parent' => $parent]);
        foreach ($topics as $topic) {
         //   dd($topic);
            $json = $this->serializer->serialize($topic, 'json');
            dd($json);
        }
        dd($result);
        return $result;
    }
}