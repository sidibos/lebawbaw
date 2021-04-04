<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    /**
     * @Route("/post/add", name="add_post")
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        // just setup a fresh $task object (remove the example data)
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $imageFiles = $form->get('images')->getData();
            
            $entityManager = $this->getDoctrine()->getManager();
            if ($imageFiles) {
                foreach($imageFiles as $imageFile) {
                    if ($postImage = $fileUploader->upload($imageFile)) {
                        $post->addPostImage($postImage);
                    }
                }
                // $images = $fileUploader->upload($imageFiles);
                // foreach($images as $postImage) {
                //     $post->addPostImage($postImage);
                // }
            }
            $post->setCreatedDate(new \DateTime('Now'))
            ->setIsActive(true)
            ->setIsFree(false)
            ->setIsPriceNegotiable(false)->setUser($this->getUser());
            
            $entityManager->persist($post);
            $entityManager->flush();
            //$post = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            return $this->redirectToRoute('post_success');
        }

        return $this->render('post/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/post/success", name="post_success")
     */
    public function postSuccess()
    {
        return $this->render('post/success.html.twig');
    }

    /**
     * @Route("/post/{slug}", name="post_show")
     */
    public function show(string $slug)
    {
        $post       = $this->getDoctrine()->getRepository(Post::class)->findOneBy(['postSlug' => $slug]);
        $postImages = $post->getPostImages();
        return $this->render('post/show.html.twig', [
            'post'          => $post,
            'postImages'    => $postImages,
            'imageCount'    => count($postImages)
        ]);
    }
}
