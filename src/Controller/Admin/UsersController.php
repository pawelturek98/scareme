<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/users")
 */
class UsersController extends AbstractController
{
    /**
     * @Route("/", name="admin_users_index")
     */
    public function index(): Response
    {
        return $this->render('admin/users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }
}
