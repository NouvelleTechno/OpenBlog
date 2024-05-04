<?php

namespace App\Controller\Admin;

use App\Entity\Keywords;
use App\Form\AddKeywordFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/keywords', name: 'app_admin_keywords_')]
class KeywordsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/keywords/index.html.twig', [
            'controller_name' => 'KeywordsController',
        ]);
    }

    #[Route('/ajouter', name: 'add')]
    public function addKeyword(
        Request $request,
        SluggerInterface $slugger,
        EntityManagerInterface $em
    ): Response
    {
        // On initialise un mot clé
        $keyword = new Keywords();

        // On initialise le formulaire
        $keywordForm = $this->createForm(AddKeywordFormType::class, $keyword);

        // On traite le formulaire
        $keywordForm->handleRequest($request);

        // On vérifie si le formulaire est envoyé et valide
        if($keywordForm->isSubmitted() && $keywordForm->isValid()){
            // On crée le slug
            $slug = strtolower($slugger->slug($keyword->getName()));
            
            // On attribue le slug à notre mot clé
            $keyword->setSlug($slug);

            // On enregistre le mot clé en base de données
            $em->persist($keyword);
            $em->flush();

            $this->addFlash('success', 'Le mot-clé a été créé');
            return $this->redirectToRoute('app_admin_keywords_index');
        }

        // On affiche la vue
        return $this->render('admin/keywords/add.html.twig', [
            'keywordForm' => $keywordForm->createView(),
        ]);
    }
}
