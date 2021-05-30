<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;

class UserEditVoter implements VoterInterface
{
     public function vote(TokenInterface $tokenInterface, $subject, array $attributes)
     {
          if (!$subject instanceof User) {
               return self::ACCESS_ABSTAIN;
          }

          if(!in_array('USER_EDIT', $attributes)) {
               return self::ACCESS_ABSTAIN;
          }

          $user = $tokenInterface->getUser();

          if (!$user instanceof User) {
               return self::ACCESS_DENIED;
          }

          if($user !== $subject) {
               return self::ACCESS_DENIED;
          }

          return self::ACCESS_GRANTED;
     }

}
