<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Repository\ContactRepository;
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
    public function index(ContactRepository $contactRepository): Response
    {
        return $this->render('admin/contact/index.html.twig', [
            'contacts' => $contactRepository->findAll()
        ]);
    }

    /**
     * @Route("/contact/show/{id}", name="contact_show")
     */
    public function show(Contact $contact): Response
    {
        $contact->setSeen(true);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($contact);
        $entityManager->flush();

        return $this->render('admin/contact/show.html.twig', [
            'contact' => $contact
        ]);
    }
}
