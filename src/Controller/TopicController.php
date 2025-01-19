<?php

namespace App\Controller;

use App\Entity\Topic;
use App\Form\TopicType;
use App\Service\Manager\TopicManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class TopicController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly TopicManager $topicManager,
    )
    {}

    #[Route('/topic', name: 'app_topic')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        $topics = $this->entityManager->getRepository(Topic::class)->findBy(['parent' => 0]);

        return $this->render('topic/index.html.twig', [
            'topics' => $topics,
        ]);
    }

    #[Route('/topic/list/{parent}', name: 'app_topic_list1')]
    #[IsGranted('ROLE_USER')]
    public function list(int $parent): Response
    {
        $topics = $this->topicManager->getTopicsByParentId($parent);
        return $this->render('topic/index.html.twig', [
            'topics' => $topics,
        ]);
    }

    #[Route('/topic/delete/{id}', name: 'app_topic_list')]
    #[IsGranted('ROLE_USER')]
    public function delete(int $id): Response
    {
        $topic = $this->entityManager->getRepository(Topic::class)->find($id);
        $parent = $topic->getParent();
        $parentId = !empty($parent)  ? $parent->getId() : '';
        $this->entityManager->remove($topic);
        $this->entityManager->flush();
        return $this->redirect("/topic/list/".$parentId);
    }

    #[Route(path: '/topic/add', name: 'app_new_topic')]
    #[IsGranted('ROLE_USER')]
    public function add(Request $request): Response
    {
        $form = $this->createForm(TopicType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $topic = $form->getData();
            $this->entityManager->persist($topic);
            $this->entityManager->flush();
            $parent = $topic->getParent();
            $parentId = !empty($parent)  ? $parent->getId() : '';

            return $this->redirect("/topic/list/".$parentId);
        }
        return $this->render('topic/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
