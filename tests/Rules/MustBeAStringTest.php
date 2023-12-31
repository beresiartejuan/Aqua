<?php

namespace Beresiartejuan\AquaTest\Rules;

use Beresiartejuan\Aqua\Exceptions\MustBeAStringException;
use Beresiartejuan\Aqua\Rules\MustBeAString;
use PHPUnit\Framework\TestCase;

final class MustBeAStringTest extends TestCase
{
    public function testRuleSuccess()
    {
        $rule = MustBeAString::class;

        $this->assertTrue($rule::check("Holi :)"));
    }

    public function testFailedSuccesfully()
    {
        $rule = MustBeAString::class;

        $this->assertIsObject($rule::check(1, false));

        $this->expectException(MustBeAStringException::class);

        $rule::check(1);
    }
}
