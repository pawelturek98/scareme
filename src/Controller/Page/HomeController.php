<?php

namespace App\Controller\Page;

use App\Entity\Contact;
use App\Entity\Newsletter;
use App\Entity\StaticPage;
use App\Form\Page\ContactType;
use App\Form\Page\NewsletterType;
use App\Repository\PostsRepository;
use App\Repository\StaticPageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(PostsRepository $postsRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'news' => $postsRepository->findFromToPosts(3),
            'others'  => $postsRepository->findFromToPosts(3,3)
        ]);
    }

    /**
     * @Route("/page/{slug}", name="static_pages")
     */
    public function page(
        StaticPageRepository $staticPageRepository,
        string $slug
    ): Response {
        $currentPage = $staticPageRepository->findPage($slug);

        if(count($currentPage) < 1) {
            throw new NotFoundHttpException("Page $slug doesn't exists");
        }

        /** @var StaticPage $currentPage */
        $currentPage = current($currentPage);
        $layout = $currentPage->getLayout();

        return $this->render("home/static_pages/$layout.html.twig", [
            'currentPage' => $currentPage
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $contact->setCreatedAt(new \DateTime('now'));

            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('contact');
        }

        return $this->render("home/contact.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/newsletter", name="newsletter")
     */
    public function newsletter(Request $request): Response {
        $newsletter = new Newsletter();
        $newsletterForm = $this->createForm(NewsletterType::class, $newsletter);
        $newsletterForm->submit(json_decode($request->getContent(), true));

        if(
            $request->getMethod() === Request::METHOD_POST &&
            $newsletterForm->isValid()
        ) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newsletter);
            $entityManager->flush();

            return new JsonResponse(['status' => 'OK'], Response::HTTP_OK);
        }

        return new JsonResponse(['status' => 'Get method is not available'], Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
