<?php

namespace App\Controller;

use App\Repository\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/articles", name="articles")
     */
    public function index(PostsRepository $postsRepository): Response
    {
        return $this->render('articles/index.html.twig', [
            'posts' => $postsRepository->findBy(['published' => true])
        ]);
    }

    /**
     * @Route("/articles/{slug}", name="article_item")
     */
    public function article(PostsRepository $postsRepository, string $slug): Response
    {
        $post = $postsRepository->findOneBy(['url_key' => $slug]);
        return $this->render('articles/article.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @Route("/articles-widget", name="articles_widget")
     */
    public function articlesWidget(PostsRepository $postsRepository): Response
    {
        $latestPosts = $postsRepository->findFromToPosts(5);
        $bestPost = $postsRepository->findBestPost();

        $response = $this->render('particles/_sidebar.html.twig', [
            'latestPosts' => $latestPosts,
            'bestPost' => $bestPost
        ]);
        $response->setPublic(true);
        $response->setMaxAge(600);

        return $response;
    }
}
