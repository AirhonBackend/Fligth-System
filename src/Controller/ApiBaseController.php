<?php

namespace App\Controller;

use App\Validation\Validator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Illuminate\Support\Str;

class ApiBaseController extends AbstractController
{
    public $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function notFoundErrorResponse($dataObject)
    {
        return [Str::lower($dataObject) => [Str::title($dataObject) . ' not found!']];
    }
}
