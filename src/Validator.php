<?php

namespace App;

interface Validator
{
    public function validateEmail(string $email): bool;
    public function validatePassword(string $password): bool;
}
