<?php

namespace App\Controller;

use App\Entity\Resource;
use App\Form\ResourceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ResourceController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $em)
    {}

    #[Route('/resource', name: 'app_resource')]
    public function index(): Response
    {
        return $this->render('resource/index.html.twig', [
            'controller_name' => 'ResourceController',
        ]);
    }

    #[Route('/resource/add', name: 'app_resource')]
    public function add(Request $request): Response
    {
        $form = $this->createForm(ResourceType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $resource = $form->getData();
            $this->em->persist($resource);
            $this->em->flush();
        }
        return $this->render('resource/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/resource/list', name: 'app_resource_edit')]
    public function list()
    {
        $all = $this->em->getRepository(Resource::class)->findAll();

        return $this->render('resource/list.html.twig', [
            'resources' => $all,
        ]);
    }
}
