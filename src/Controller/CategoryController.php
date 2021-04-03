<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    /**
     * @Route("/category/{slug}", name="show_category")
     */
    public function show(string $slug)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->findOneBy([
            'categorySlug' => $slug
            ]);
        $posts = $category->getPosts();

        return $this->render('category/show.html.twig', [
            'categorySlug'  => $slug,
            'categoryName'  => $category->getCategoryName(),
            'posts'         => $posts,
            'postsNum'      => count($posts),
        ]);
    }
}
