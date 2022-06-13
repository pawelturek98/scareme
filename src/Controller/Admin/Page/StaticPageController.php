<?php

namespace App\Controller\Admin\Page;

use App\Entity\StaticPage;
use App\Form\Page\StaticPageType;
use App\Repository\StaticPageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/admin/static/page")
 */
class StaticPageController extends AbstractController
{
    private $_security;

    public function __construct(Security $security)
    {
        $this->_security = $security;
    }

    /**
     * @Route("/", name="admin_static_page_index", methods={"GET"})
     */
    public function index(StaticPageRepository $staticPageRepository): Response
    {
        return $this->render('admin/static_page/index.html.twig', [
            'static_pages' => $staticPageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="static_page_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $staticPage = new StaticPage();
        $form = $this->createForm(StaticPageType::class, $staticPage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $staticPage->setCreatedAt(new \DateTime('now'));
            if($form->get('published')) {
                $staticPage->setPublishedAt(new \DateTime('now'));
            }

            $entityManager->persist($staticPage);
            $entityManager->flush();

            return $this->redirectToRoute('admin_static_page_index');
        }

        return $this->render('admin/static_page/new.html.twig', [
            'static_page' => $staticPage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="static_page_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, StaticPage $staticPage): Response
    {
        $form = $this->createForm(StaticPageType::class, $staticPage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_static_page_index');
        }

        return $this->render('admin/static_page/edit.html.twig', [
            'static_page' => $staticPage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="static_page_delete", methods={"POST"})
     */
    public function delete(Request $request, StaticPage $staticPage): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($staticPage);
        $entityManager->flush();

        return new JsonResponse(['status' => 'ok', 'url' => $this->generateUrl('admin_static_page_index')]);
    }
}
