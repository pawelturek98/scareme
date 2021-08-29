<?php

namespace App\Controller;

use App\Entity\Ratings;
use App\Repository\PostsRepository;
use App\Repository\RatingsRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route ("/article/rating", name="article_rating")
     */
    public function rating(
        RatingsRepository $ratingsRepository,
        PostsRepository $postsRepository,
        Request $request
    ): JsonResponse
    {

        $rating = $ratingsRepository->findBy([
            'ip_address' => $request->getClientIp(),
            'post_id' => $request->get('post_id')
        ]);

        if(count($rating) > 0) {
            return new JsonResponse(["status" => "error", "message" => "You already voted"], Response::HTTP_BAD_REQUEST);
        }

        $post = $postsRepository->findOneBy(['id' => $request->get("post_id")]);


        $rating = new Ratings();
        $rating->setType($request->get("type"));
        $rating->setIpAddress($request->getClientIp());
        $rating->setPostId($post);
        $rating->setRatingDate(new \DateTime("now"));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($rating);
        $entityManager->flush();


        return new JsonResponse([
            "status" => "ok",
            "message" => "Voted successfully",
            "votes" => [
                "up" => $post->getUpVotesCount(),
                "down" => $post->getDownVotesCount()
            ]
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
