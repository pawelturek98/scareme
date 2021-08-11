<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Newsletter;
use App\Form\ContactType;
use App\Repository\PostsRepository;
use App\Repository\StaticPageRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
    public function page(StaticPageRepository $staticPageRepository, string $slug): Response
    {
        $currentPage = $staticPageRepository->findPage($slug);

        if(count($currentPage) < 1) {
            throw new NotFoundHttpException("Page $slug doesn't exists");
        }

        $currentPage = $currentPage[0];

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
    public function newsletter(Request $request, ValidatorInterface $validator): Response
    {
        $newsletter = new Newsletter();
        if($request->isMethod(Request::METHOD_POST)) {
            $data = json_decode($request->getContent());

            if(!isset($data->email)) {
                return new JsonResponse(['status' => 'Email must be set'], Response::HTTP_BAD_REQUEST);
            }

            $emailConstraint = new Assert\Email();
            $emailConstraint->message = 'Invalid email address';
            $errors = $validator->validate(
                $data->email,
                $emailConstraint
            );

            if(count($errors) > 0) {
                return new JsonResponse(['status' => $errors[0]->getMessage()], Response::HTTP_BAD_REQUEST);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $newsletter->setEmail($data->email);
            $entityManager->persist($newsletter);
            $entityManager->flush();

            return new JsonResponse(['status' => 'OK'], Response::HTTP_OK);
        }

        return new JsonResponse(['status' => 'Get method is not available'], Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
