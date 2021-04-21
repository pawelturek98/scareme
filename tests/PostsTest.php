<?php
//
//namespace App\Tests;
//
//use PHPUnit\Framework\TestCase;
//
////use App\Entity\Posts;
//use App\Repository\PostsRepository;
//
//class PostsTest extends TestCase
//{
//    public function testSomething(): void
//    {
//        $this->assertTrue(true);
//    }
//
//    public function testAddingPost(): void
//    {
//        $post = new Posts();
//
//        $data = [
//            'category' => 1,
//            'author' => 0,
//            'published' => 0,
//            'title' => 'Post PL',
//            'description' => 'Post pl description',
//            'short_description' => '',
//            'meta_name' => '',
//            'meta_description' => '',
//            'meta_keywords' => '',
//            'url_key' => 'post-pl',
//            'language' => 0
//        ];
//
//        $created = $post->createPost($data);
//
//        $this->assertTrue($created);
//    }
//
//    public function testAddingPostWithEmptyData(): void
//    {
//        $post = new Posts();
//
//        $data = [
//            'category' => null,
//            'author' => null,
//            'published' => null,
//            'title' => null,
//            'description' => null,
//            'short_description' => null,
//            'meta_name' => null,
//            'meta_description' => null,
//            'meta_keywords' => null,
//            'url_key' => null,
//            'language' => null
//        ];
//
//        $created = $post->createPost($data);
//
//        $this->assertFalse($created);
//    }
//
//    public function testAddingPostWithEmtpyUrlKey(): void
//    {
//        $post = new Posts();
//
//        $data = [
//            'category' => 1,
//            'author' => 1,
//            'published' => 0,
//            'title' => 'Post PL',
//            'description' => 'Post pl description',
//            'short_description' => '',
//            'meta_name' => '',
//            'meta_description' => '',
//            'meta_keywords' => '',
//            'url_key' => '',
//            'language' => 0
//        ];
//
//        $created = $post->createPost($data);
//
//        $this->assertFalse($created);
//    }
//}