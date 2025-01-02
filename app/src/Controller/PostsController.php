<?php

namespace App\Controller;

use App\Repository\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path:'/articles', name:'app_posts_')]
class PostsController extends AbstractController
{
    #[Route(path:'/details/{slug}', name:'details')]
    public function details($slug, PostsRepository $postsRepository): Response
    {
        $post = $postsRepository->findOneBy(['slug'=> $slug]);

        // Si le post n'existe pas
        if(!$post){
            throw $this->createNotFoundException('Cet article n\'existe pas');
        }

        // Ici l'article existe, on l'envoie à la vue
        return $this->render('posts/details.html.twig', compact('post'));
    }
}