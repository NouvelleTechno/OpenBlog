<?php

namespace App\Controller\Profile;

use App\Entity\Posts;
use App\Form\AddPostFormType;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/profil/articles', name: 'app_profile_posts_')]
class PostsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('profile/posts/index.html.twig', [
            'controller_name' => 'PostsController',
        ]);
    }

    #[Route('/ajouter', name: 'add')]
    public function addArticle(
        Request $request,
        SluggerInterface $slugger,
        EntityManagerInterface $em,
        UsersRepository $usersRepository
    ): Response
    {
        $post = new Posts();

        $form = $this->createForm(AddPostFormType::class, $post);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $post->setSlug(strtolower($slugger->slug($post->getTitle())));

            $post->setUsers($usersRepository->find(1));

            $post->setFeaturedImage('default.webp');

            $em->persist($post);
            $em->flush();

            $this->addFlash('success', 'L\'article a été créé');
            return $this->redirectToRoute('app_profile_posts_index');
        }

        return $this->render('profile/posts/add.html.twig', [
            'form' => $form
        ]);
    }
}
