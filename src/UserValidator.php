<?php

namespace App;

readonly class UserValidator implements Validator
{
    private const array SPECIAL_CHARS = [
        '!', '@', '#', '%', '&', '?', '*', '~', '_', '-', '{', '}', "'", '<', '$', '+',
        '^', '|', '.', ',', '.', ':', ';', '/', '\\', '(', ')', '[', ']', '"', '>', '=',
    ];

    public function __construct(
        private int $minPasswordLength,
        private int $minUppercaseCount,
        private int $minLowercaseCount,
        private int $minDigitCount,
        private int $minSpecialCharCount,

        /**
         * @var string[]
         */
        private array $specialChars = self::SPECIAL_CHARS,
    ) {
    }

    public function validateEmail(string $email): bool
    {
        // TODO

        return false;
    }

    public function validatePassword(string $password): bool
    {
        // TODO

        return false;
    }
}
