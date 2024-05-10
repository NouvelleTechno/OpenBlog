<?php

namespace App\Controller;

use App\Form\ResetPasswordFormType;
use App\Form\ResetPasswordRequestFormType;
use App\Repository\UsersRepository;
use App\Service\JWTService;
use App\Service\SendEmailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/mot-de-passe-oublie', name: 'forgotten_password')]
    public function forgottenPassword(
        Request $request,
        UsersRepository $usersRepository,
        JWTService $jwt,
        SendEmailService $mail
    ) : Response
    {
        $form = $this->createForm(ResetPasswordRequestFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // Le formulaire est envoyé ET valide
            // On va chercher l'utilisateur dans la base
            $user = $usersRepository->findOneByEmail($form->get('email')->getData());

            // On vérifie si on a un utilisateur
            if($user){
                // On a un utilisateur
                // On génère un JWT
                // Header
                $header = [
                    'typ' => 'JWT',
                    'alg' => 'HS256'
                ];

                // Payload
                $payload = [
                    'user_id' => $user->getId()
                ];

                // On génère le token
                $token = $jwt->generate($header, $payload, $this->getParameter('app.jwtsecret'));

                // On génère l'URL vers reset_password
                $url = $this->generateUrl('reset_password', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);

                // Envoyer l'e-mail
                $mail->send(
                    'no-reply@openblog.test',
                    $user->getEmail(),
                    'Récupération de mot de passe sur le site OpenBlog',
                    'password_reset',
                    compact('user', 'url') // ['user' => $user, 'url'=>$url]
                );

                $this->addFlash('success', 'Email envoyé avec succès');
                return $this->redirectToRoute('app_login');

            }
            // $user est null
            $this->addFlash('danger', 'Un problème est survenu');
            return $this->redirectToRoute('app_login');
        }



        return $this->render('security/reset_password_request.html.twig', [
            'requestPassForm' => $form->createView()
        ]);
    }


    #[Route('/mot-de-passe-oublie/{token}', name: 'reset_password')]
    public function resetPassword(
        $token,
        JWTService $jwt,
        UsersRepository $usersRepository,
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $em
    ): Response
    {
        
        // On vérifie si le token est valide (cohérent, pas expiré et signature correcte)
        if($jwt->isValid($token) && !$jwt->isExpired($token) && $jwt->check($token, $this->getParameter('app.jwtsecret'))){
            // Le token est valide
            // On récupère les données (payload)
            $payload = $jwt->getPayload($token);
            
            
            // On récupère le user
            $user = $usersRepository->find($payload['user_id']);

            if($user){
                $form = $this->createForm(ResetPasswordFormType::class);

                $form->handleRequest($request);

                if($form->isSubmitted() && $form->isValid()){
                    $user->setPassword(
                        $passwordHasher->hashPassword($user, $form->get('password')->getData())
                    );

                    $em->flush();

                    $this->addFlash('success', 'Mot de passe changé avec succès');
                    return $this->redirectToRoute('app_login');
                }
                return $this->render('security/reset_password.html.twig', [
                    'passForm' => $form->createView()
                ]);
            }
        }
        $this->addFlash('danger', 'Le token est invalide ou a expiré');
        return $this->redirectToRoute('app_login');
    }
}
