<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\ConstraintValidator;

class IsValidUserValidator extends ConstraintValidator
{

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\IsValidOwner */

        if (null === $value || '' === $value) {
            return;
        }

        $user = $this->security->getUser();
        if(!$user instanceof User) {
            $this->context->buildViolation($constraint->anonymousMessage)
                ->addViolation();
                return;
        }

        if($this->security->isGranted('ROLE_ADMIN')) {
            return;
        }

        if($value !== $user->getId()) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
