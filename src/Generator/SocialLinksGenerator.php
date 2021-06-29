<?php
namespace App\Generator;

class SocialLinksGenerator
{
    public $postRepository;

    public function __construct(
        \App\Repository\PostsRepository $postsRepository
    ) {
        $this->postRepository = $postsRepository;
    }
}