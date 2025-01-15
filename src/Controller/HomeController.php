<?php

namespace App\Controller;

use App\Entity\Resource;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    { }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $resources = $this->entityManager->getRepository(Resource::class)->findBy(['finishDate' => null]);

        return $this->render('home/index.html.twig', [
            'resources' => $resources,
        ]);
    }
}
