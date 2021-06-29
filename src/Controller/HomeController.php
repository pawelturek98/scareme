<?php

namespace App\Controller;

use App\Repository\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
    public function page(string $slug): Response
    {
        /*
         * Layout będzie pobierany z Entity stron statycznych 
         */
        $layout = "1-column";

        /*
         * Dodatkowymi parametrami dla stron statycznych powinny być:
         *  - Nazwa strony
         *  - Kontent strony
         *  - Roboty (follow / no-follow)
         *  - Przyjazny tytuł
         *  - Opis strony
         *  - Url slug
         *  - Opublikowany / nieopublikowany
         *  - Datę utworzenia
         *  - Datę publikacji
         *  - Autora 
         */
        return $this->render("home/static-pages/$layout.html.twig", [
        
        ]);
    }
}
