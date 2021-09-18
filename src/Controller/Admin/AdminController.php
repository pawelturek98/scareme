<?php

namespace App\Controller\Admin;

use App\Repository\PostsRepository;
use App\Repository\UserRepository;
use App\Repository\VisitorsStatisticsRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(PostsRepository $postsRepository, UserRepository $userRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'bestPosts' => $postsRepository->findFromToPosts(5),
            'newUsers' => $userRepository->findBy([], ['id' => 'asc'], 5),
        ]);
    }

    /**
     * @Route("/admin/stats", name="admin_stats")
     */
    public function stats(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => "Statystyki administratora"
        ]);
    }

    /**
     * @Route("/admin/stats-ajax", name="admin_stats_ajax")
     */
    public function statsAjax(VisitorsStatisticsRepository $visitorsStatisticsRepository): JsonResponse
    {
        return new JsonResponse($visitorsStatisticsRepository->getStatistics());
    }
}
