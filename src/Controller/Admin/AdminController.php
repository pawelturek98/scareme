<?php

namespace App\Controller\Admin;

use App\Repository\VisitorsStatisticsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
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
