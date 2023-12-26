<?php

namespace Beresiartejuan\AquaTest;

use Beresiartejuan\Aqua\Exceptions\PointerMustNotBeNull;
use PHPUnit\Framework\TestCase;
use Beresiartejuan\Aqua\Validator;

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
}
