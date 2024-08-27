<?php

namespace App\ValidatorConstraint;

use Symfony\Component\Validator\Context\ExecutionContextInterface;

class UserValidator
{
    public static function validateFirstName($firstName, ExecutionContextInterface $context): void
    {
        if (preg_match('/\d/', $firstName)) {
            $context->buildViolation('First name cannot contain numbers !')
                ->atPath('firstName')
                ->addViolation();
        }
    }

    public static function validateLastName($lastName, ExecutionContextInterface $context): void
    {
        if (preg_match('/\d/', $lastName)) {
            $context->buildViolation('Last name cannot contain numbers !')
                ->atPath('firstName')
                ->addViolation();
        }
    }

    public static function validatePhoneNumber($phoneNumber, ExecutionContextInterface $context): void
    {
        if (!preg_match('/^0[1-9][0-9]{8}$/', $phoneNumber)) {
            $context->buildViolation('Please enter a valid phone number !')
                ->atPath('phoneNumber')
                ->addViolation();
        }
    }
}
