<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UsersType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin/users")
 */
class UsersController extends AbstractController
{
    /**
     * @Route("/", name="admin_users_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin/users/index.html.twig', [
            'users' => $userRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="users_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get("plainPassword")->getData()
                )
            );

            $user->setRoles([$form->get('role')->getData()]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
        }

        return $this->render('admin/users/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="users_edit", methods={"POST", "GET"})
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get("plainPassword")->getData()
                )
            );

            $user->setRoles([$form->get('role')->getData()]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('users_show', ['id' => $user->getId()]);
        }

        return $this->render('admin/users/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    /**
     * @Route("/{id}/show", name="users_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('admin/users/show.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/{id}/delete", name="users_delete", methods={"POST"})
     */
    public function delete(User $user): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        return new JsonResponse(['status' => 'ok', 'url' => $this->generateUrl('admin_users_index')]);
    }
}
