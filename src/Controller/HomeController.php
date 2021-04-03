<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
    * @Route("/", name="home_page")
     */
    public function index(): Response
    {
        $categoryList = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findBy(['parent' => null]);


        return $this->render('home/index.html.twig', [
            'parentCategories' => $categoryList,
        ]);
    }
}
