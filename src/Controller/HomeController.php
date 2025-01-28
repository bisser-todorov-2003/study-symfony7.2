<?php

namespace App\Controller;

use App\Entity\Resource;
use App\Service\Manager\ResourceManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class HomeController extends AbstractController
{
    public function __construct(private readonly ResourceManager $resourceManager)
    {}

    #[IsGranted('ROLE_USER')]
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        if (empty($year)) {
            $now = new \DateTime();
            $year = $now->format('Y');
        }

        $previousYear = (string)((int) $year - 1);
        $progress = $this->resourceManager->inProgressByYear($year);
        $finish = $this->resourceManager->finishedByYear($year);

        $previousProgress = $this->resourceManager->inProgressByYear($previousYear);
        $previousFinish = $this->resourceManager->finishedByYear($previousYear);

        $otherActivities = $this->resourceManager->otherActivitiesByYear();

        return $this->render('/home/index.html.twig', [
            'progress' => $progress,
            'finish' => $finish,
            'year' => $year,
            'previousYear' => $previousYear,
            'previousProgress' => $previousProgress,
            'previousFinish' => $previousFinish
        ]);
    }


}
