<?php

namespace App\Validation;

use Symfony\Component\Validator\Validator\ValidatorInterface;


class Validator
{
    private $validator;

    private $errors;

    public function __construct(ValidatorInterface $validatorInterface)
    {
        $this->validator = $validatorInterface;
    }

    public function validateDataObjects($dataObjects)
    {
        $errors = $this->validator->validate($dataObjects);

        $this->errors = $errors;

        return $this;
    }

    public function fails()
    {
        return count($this->errors) > 0 ? true : false;
    }

    public function getErrorMessages()
    {
        $errorMessages = [];

        foreach ($this->errors as $error) {
            $errorMessages[$error->getPropertyPath()][] = $error->getMessage();
        }

        return $errorMessages;
    }
}
