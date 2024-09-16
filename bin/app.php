<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\UserValidator;

$validator = new UserValidator(
    minPasswordLength: 8,
    minUppercaseCount: 1,
    minLowercaseCount: 1,
    minDigitCount: 1,
    minSpecialCharCount: 1,
);

var_dump($validator->validateEmail('test@example.com'));
var_dump($validator->validatePassword('StrongPass1!'));
