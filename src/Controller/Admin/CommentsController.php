<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/comments")
 */
class CommentsController extends AbstractController
{
    /**
     * @Route("/", name="admin_comments_index")
     */
    public function index(): Response
    {
        return $this->render('admin/comments/index.html.twig', [
            'controller_name' => 'CommentsController',
        ]);
    }
}
