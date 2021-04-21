<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/roles")
 */
class RolesController extends AbstractController
{
    /**
     * @Route("/", name="admin_roles_index")
     */
    public function index(): Response
    {
        return $this->render('admin/roles/index.html.twig', [
            'controller_name' => 'RolesController',
        ]);
    }
}
