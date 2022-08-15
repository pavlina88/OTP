<?php

use PHPUnit\Framework\TestCase;

class RegisterFormTest extends TestCase
{
    public function testValidatePhone()
    {
        $inputPhone = '0887 (54-54-54)';
        $validate  = $this->createMock(RegistrationForm::class);
        $validate->method('validatePhone')->with($inputPhone)->willReturn('+359887545454');
    }

    public function testhashPassword()
    {
        $inputPass = 'rasmuslerdorf';
        $validate  = $this->createMock(RegistrationForm::class);
        $validate->method('hashPassword')->with($inputPass)->willReturn('$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a');
    }
}