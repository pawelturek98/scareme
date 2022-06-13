<?php

namespace App\Controller\Admin\Page;

use App\Entity\PageSettings;
use App\Form\Page\PageSettingsType;
use App\Repository\PageSettingsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/settings")
 */
class SettingsController extends AbstractController
{
    /**
     * @Route("/", name="admin_settings_index")
     */
    public function index(Request $request, PageSettingsRepository $pageSettingsRepository): Response
    {
        $settings = $pageSettingsRepository->find(1);

        if($settings == null) {
            $settings = new PageSettings();
        }

        $form = $this->createForm(PageSettingsType::class, $settings);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($settings);
            $entityManager->flush();
        }

        return $this->render('admin/settings/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
