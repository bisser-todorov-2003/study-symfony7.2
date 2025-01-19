<?php

namespace App\Service\Manager;

use App\Entity\Topic;
use Doctrine\ORM\EntityManagerInterface;

class TopicManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {}

    public function getTopicsByParentId(?int $parent): array
    {
        $topics = [];
        $topics = $this->entityManager->getRepository(Topic::class)->findBy(['parent' => $parent]);
        return $topics;
    }
}