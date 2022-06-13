<?php

namespace App\Controller\Admin\Page;

use App\Entity\Languages;
use App\Form\Page\LanguagesType;
use App\Repository\LanguagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/languages")
 */
class LanguagesController extends AbstractController
{
    /**
     * @Route("/", name="admin_languages_index", methods={"GET"})
     */
    public function index(LanguagesRepository $languagesRepository): Response
    {
        return $this->render('admin/languages/index.html.twig', [
            'languages' => $languagesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="languages_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $language = new Languages();
        $form = $this->createForm(LanguagesType::class, $language);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($language);
            $entityManager->flush();

            return $this->redirectToRoute('admin_languages_index');
        }

        return $this->render('admin/languages/new.html.twig', [
            'language' => $language,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="languages_show", methods={"GET"})
     */
    public function show(Languages $language): Response
    {
        return $this->render('admin/languages/show.html.twig', [
            'language' => $language,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="languages_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Languages $language): Response
    {
        $form = $this->createForm(LanguagesType::class, $language);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_languages_index');
        }

        return $this->render('admin/languages/edit.html.twig', [
            'language' => $language,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="languages_delete", methods={"POST"})
     */
    public function delete(Request $request, Languages $language): Response
    {
        if ($this->isCsrfTokenValid('delete'.$language->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($language);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_languages_index');
    }
}
