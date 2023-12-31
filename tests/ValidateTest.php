<?php

namespace Beresiartejuan\AquaTest;

use Beresiartejuan\Aqua\Exceptions\PointerMustNotBeNull;
use Beresiartejuan\Aqua\Validator;
use PHPUnit\Framework\TestCase;

class ExampleException extends \Exception

{}

final class ValidateTest extends TestCase
{
    public function testSetPointerCorrectly()
    {
        $validator = new Validator();
        $validator->field("name");

        $this->assertIsString($validator->getPointer());
        $this->assertEquals("name", $validator->getPointer());
    }

    public function testFailedWithoutPointer()
    {
        $validator = new Validator();

        $this->expectException(PointerMustNotBeNull::class);

        $validator->string();

        $this->assertNull($validator->getPointer());
    }

    public function testPushANewRule()
    {
        $validator = new Validator();

        $validator->field("username")->string();

        $this->assertNotNull($validator->getPointer());

        $this->assertNotEmpty($validator->getRules());

        $this->assertTrue($validator->check([
            "username" => "Juanito123",
        ]));
    }

    public function testCheckCustomRule()
    {

        $validator = new Validator();

        $validator->field("username")->string();
        $validator
            ->field("password")
            ->string()
            ->custom(function (string $password) {
                if (strlen($password) < 4) {
                    throw new ExampleException("Your password must be more large");
                }
            });

        $result_true = $validator->check([
            "username" => "Juanito",
            "password" => "ContraseñaSegura",
        ]);

        $this->assertTrue($result_true);

        $exception = $validator->check([
            "username" => "Juanito",
            "password" => "12",
        ], false);

        $this->assertInstanceOf(ExampleException::class, $exception);

        $this->expectException(ExampleException::class);

        $validator->check([
            "username" => "Juanito",
            "password" => "12",
        ], true);

    }
}
