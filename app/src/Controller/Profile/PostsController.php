<?php

namespace App\Controller\Profile;

use App\Entity\Posts;
use App\Form\AddPostFormType;
use App\Repository\PostsRepository;
use App\Repository\UsersRepository;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
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
        UsersRepository $usersRepository,
        PictureService $pictureService
    ): Response
    {
        $post = new Posts();

        $form = $this->createForm(AddPostFormType::class, $post);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $post->setSlug(strtolower($slugger->slug($post->getTitle())));

            $post->setUsers($this->getUser());
            
            $featuredImage = $form->get('featuredImage')->getData();

            $image = $pictureService->square($featuredImage, 'articles', 300);

            $post->setFeaturedImage($image);

            $em->persist($post);
            $em->flush();

            $this->addFlash('success', 'L\'article a été créé');
            return $this->redirectToRoute('app_profile_posts_index');
        }

        return $this->render('profile/posts/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/modifier/{id}', name: 'edit')]
    public function editArticle(
        $id,
        Request $request,
        SluggerInterface $slugger,
        EntityManagerInterface $em,
        PostsRepository $postsRepository,
        PictureService $pictureService
    ): Response
    {
        $post = $postsRepository->find($id);

        // Si on n'a pas de post
        if(!$post){
            return $this->redirectToRoute('app_profile_index');
        }

        // On vérifie les permissions
        $this->denyAccessUnlessGranted('POST_EDIT', $post);

        $form = $this->createForm(AddPostFormType::class, $post);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $post->setSlug(strtolower($slugger->slug($post->getTitle())));

            $post->setUsers($this->getUser());

            $featuredImage = $form->get('featuredImage')->getData();

            $image = $pictureService->square($featuredImage, 'articles', 300);

            $post->setFeaturedImage($image);

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
