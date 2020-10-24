<?php

declare(strict_types=1);

namespace App\Infrastructure\UI\Http\Middleware\Validator;

use App\Infrastructure\UI\Http\HttpRequest;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestValidator
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(HttpRequest $request): void
    {
        $errors = $this->validator->validate($request);

        if (count($errors) > 0) {
            throw new RequestValidationException($this->getErrorMessages($errors));
        }
    }

    private function getErrorMessages(ConstraintViolationListInterface $errors): array
    {
        $errorList = [];
        foreach ($errors as $error) {
            $errorList[$error->getPropertyPath()] = $error->getMessage();
        }

        return $errorList;
    }
}
