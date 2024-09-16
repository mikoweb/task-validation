<?php

namespace App;

use IntlChar;

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
        $tests = [
            'testMinPasswordLength',
            'testMinUppercaseCount',
            'testMinLowercaseCount',
            'testMinDigitCount',
            'testMinSpecialCharCount',
        ];

        foreach ($tests as $test) {
            if (!$this->$test($password)) {
                return false;
            }
        }

        return true;
    }

    private function testMinPasswordLength(string $password): bool
    {
        return strlen($password) >= $this->minPasswordLength;
    }

    private function testMinUppercaseCount(string $password): bool
    {
        return $this->countIntlChar($password, 'isupper') >= $this->minUppercaseCount;
    }

    private function testMinLowercaseCount(string $password): bool
    {
        return $this->countIntlChar($password, 'islower') >= $this->minLowercaseCount;
    }

    private function testMinDigitCount(string $password): bool
    {
        return $this->countIntlChar($password, 'isdigit') >= $this->minDigitCount;
    }

    private function testMinSpecialCharCount(string $password): bool
    {
        return array_reduce(
            str_split($password),
            fn (int $sum, string $char) => $sum + in_array($char, $this->specialChars),
            0,
        ) >= $this->minSpecialCharCount;
    }

    private function countIntlChar(string $text, string $method): int
    {
        return array_reduce(
            str_split($text),
            fn (int $sum, string $char) => $sum + IntlChar::$method($char),
            0,
        );
    }
}
