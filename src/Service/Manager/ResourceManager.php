<?php

namespace App\Service\Manager;

use App\Entity\Resource;
use Doctrine\ORM\EntityManagerInterface;

class ResourceManager
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {}
    public function inProgressByYear(string $year = '2025'): array
    {
        $resources = $this->entityManager->getRepository(Resource::class)->findBy(['finishDate' => null]);
        $currentYear = new \DateTime($year.'-01-01');
        $result = [];

        foreach ($resources as $resource) {
            if ($currentYear < $resource->getStartDate()) {
                $result[] = $resource;
            }
        }

        return $result;

    }

    public function currentYearFinished(): array
    {

    }
}