<?php

namespace App\Service\Manager;

use App\Entity\ProgressLog;
use App\Entity\Resource;
use Doctrine\ORM\EntityManagerInterface;

class ResourceManager
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {}
    public function inProgressByYear(?string $year = null): array
    {
        if (empty($year)) {
            $now = new \DateTime();
            $year = $now->format('Y');
        }
        return $this->entityManager->getRepository(Resource::class)->findByStarted($year);
    }

    public function finishedByYear(?string $year = null): array
    {

        if (empty($year)) {
            $now = new \DateTime();
            $year = $now->format('Y');
        }
        return $this->entityManager->getRepository(Resource::class)->findByFinished($year);
    }

    public function otherActivitiesByYear(?string $year = null): array
    {
        if (empty($year)) {
            $now = new \DateTime();
            $year = $now->format('Y');
        }
        $data = $this->entityManager->getRepository(ProgressLog::class)->otherActivitiesByYear($year);
        dd($data[0]->getResource());
    }

    public function allByYear(string $year = '2025'): array
    {

    }
}