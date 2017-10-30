<?php

namespace Evolaze\Paiod\AppBundle\Security\Voter;

use Evolaze\Paiod\AppBundle\Entity\Uzer;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class StdClassVoter extends Voter
{
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';

    /** @var AccessDecisionManagerInterface */
    protected $decisionManager;

    /**
     * @param AccessDecisionManagerInterface $decisionManager
     */
    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    /**
     * {@inheritdoc}
     */
    protected function supports($attribute, $subject)
    {
        return in_array($attribute, [self::VIEW, self::EDIT, self::DELETE])
            && ($subject instanceof \stdClass);
    }

    /**
     * {@inheritdoc}
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        /** @var \stdClass $subject */
        if (!($token->getUser() instanceof Uzer)) {
            // the user must be logged in; if not, deny access
            return false;
        }

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($subject, $token->getUser());
            case self::EDIT:
                return $this->canEdit($subject, $token->getUser());
            case self::DELETE:
                return $this->decisionManager->decide($token, [
                    'ROLE_SUPER_ADMIN',
                ]);
            default:
                throw new \LogicException('This code should not be reached!');
        }
    }

    /**
     * @param \stdClass $subject
     * @param Uzer $user
     *
     * @return bool
     */
    private function canView(\stdClass $subject, Uzer $user)
    {
        return $subject->username === $user->getUsername();
    }

    /**
     * @param \stdClass $subject
     * @param Uzer $user
     *
     * @return bool
     */
    private function canEdit(\stdClass $subject, Uzer $user)
    {
        return $subject->username === $user->getUsername();
    }
}
