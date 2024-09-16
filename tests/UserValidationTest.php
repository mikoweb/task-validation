<?php

namespace App\Tests;

use App\UserValidator;
use App\Validator;
use PHPUnit\Framework\TestCase;

final class UserValidationTest extends TestCase
{
    public function testPasswordValidation(): void
    {
        $validator = $this->createValidator();

        $this->assertTrue($validator->validatePassword('Ab@cdef1'));
        $this->assertTrue($validator->validatePassword('StrongPass1!'));
        $this->assertTrue($validator->validatePassword('i6T$bJp6m6b=qp5k'));
        $this->assertTrue($validator->validatePassword('xAL2r5BZI\Xa#TZ^'));
        $this->assertTrue($validator->validatePassword('kRm<+$Clc78do6@N'));
        $this->assertTrue($validator->validatePassword('F\E6FTp<'));
        $this->assertTrue($validator->validatePassword('$eFUBoa2'));

        $this->assertFalse($validator->validatePassword('l6ZQ>\b'));
        $this->assertFalse($validator->validatePassword('12345678'));
        $this->assertFalse($validator->validatePassword('abcdefgh'));
        $this->assertFalse($validator->validatePassword('abcde1gh'));
        $this->assertFalse($validator->validatePassword('abCde1gh'));
    }

    public function testEmailValidation(): void
    {
        $validator = $this->createValidator();

        $this->assertTrue($validator->validateEmail('test@example.com'));
        $this->assertTrue($validator->validateEmail('test@example.pl'));
        $this->assertTrue($validator->validateEmail('tEst@exAMple.pl'));
        $this->assertTrue($validator->validateEmail('a@b.pl'));
        $this->assertTrue($validator->validateEmail('mike789@gmail.com'));
        $this->assertTrue($validator->validateEmail('jan.kowalski@onet.pl'));

        $this->assertFalse($validator->validateEmail('mike789@gmail.123'));
        $this->assertFalse($validator->validateEmail('mike789@pl'));
        $this->assertFalse($validator->validateEmail('mike789@a'));
        $this->assertFalse($validator->validateEmail('mike789@localhost'));
        $this->assertFalse($validator->validateEmail('jan*kowalski@onet.pl'));
    }

    private function createValidator(): Validator
    {
        return new UserValidator(
            minPasswordLength: 8,
            minUppercaseCount: 1,
            minLowercaseCount: 1,
            minDigitCount: 1,
            minSpecialCharCount: 1,
        );
    }
}
