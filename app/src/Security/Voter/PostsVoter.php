<?php

namespace App\Security\Voter;

use App\Entity\Posts;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class PostsVoter extends Voter
{
    public const EDIT = 'POST_EDIT';
    public const DELETE = 'POST_DELETE';

    public function __construct(private readonly Security $security){}

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::EDIT, self::DELETE]) && $subject instanceof Posts;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        if($this->security->isGranted('ROLE_ADMIN')) return true;

        switch ($attribute) {
            case self::EDIT:
            case self::DELETE:
                // On vérifie si l'utilisateur est l'auteur du post
                return $this->isOwner($subject, $user);
        }
        return false;
    }

    private function isOwner(Posts $post, $user): bool
    {
        return $user === $post->getUsers();
    }
}