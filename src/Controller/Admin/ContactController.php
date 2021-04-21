<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/contact")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/", name="admin_contact_index")
     */
    public function index(): Response
    {
        return $this->render('admin/contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
