<?php

namespace App\Controller;

use App\Entity\Resource;
use App\Service\Manager\ResourceManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(private readonly ResourceManager $resourceManager)
    { }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $resources = $this->resourceManager->inProgressByYear();

        return $this->render('home/index.html.twig', [
            'resources' => $resources,
        ]);
    }


}
