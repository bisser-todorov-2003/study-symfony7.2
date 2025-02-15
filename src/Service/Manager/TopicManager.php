<?php

namespace App\Service\Manager;

use App\DTO\TopicDTO;
use App\Entity\Resource;
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
            // TODO: Entity of type 'App\Entity\Topic' for IDs id(0) was not found
            // try to use serializer
            $dto = new TopicDTO();
            $dto->setId($topic->getId());
            $dto->setName($topic->getName());
            $time = $this->calculateTime($topic);
            $dto->setDuration((int) ($time/60));
            $result[] = $dto;
        }
        return $result;
    }

    private function calculateTime(Topic $topic): int
    {
        // TODO: Refactor this
        $hours = 0;
        $resources = $topic->getResources();

        if (!empty($resources->toArray())) {
            /** @var Resource $resource */
            foreach ($resources->toArray() as $resource) {
                if ($resource->getProgress() == 100) {
                    $hours += $resource->getSize();
                }
            }
        }
        $children = $this->entityManager->getRepository(Topic::class)->findBy(['parent' => $topic->getId()]);

        if (empty($children)) {
            return $hours;
        }
        foreach ($children as $child) {
            $hours += $this->calculateTime($child);
        }
        return $hours;
    }
}