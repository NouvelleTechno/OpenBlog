<?php

namespace App\Controller;

use App\Repository\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path:'/articles', name:'app_posts_')]
class PostsController extends AbstractController
{
    #[Route(path:'', name:'index')]
    public function index(PostsRepository $postsRepository, Request $request): Response
    {
        // On récupère le numéro de page
        $page = $request->query->get('page',1);

        $data = $postsRepository->getAllPaginated($page, 2);
        
        return $this->render('posts/index.html.twig', compact('data'));
    }

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