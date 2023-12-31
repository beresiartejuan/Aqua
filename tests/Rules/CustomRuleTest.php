<?php

namespace Beresiartejuan\AquaTest\Rules;

use Beresiartejuan\Aqua\Exceptions\MustBeAStringException;
use Beresiartejuan\Aqua\Rules\CustomRule;
use PHPUnit\Framework\TestCase;

final class CustomRuleTest extends TestCase
{
    public function testOne()
    {
        $custom = new CustomRule(function ($value) {
            if (!is_string($value)) {
                throw new MustBeAStringException();
            }
        });

        $true_result = $custom::check($custom, "Holi", false);

        $this->assertTrue($true_result);

        $error_result = $custom::check($custom, 2, false);

        $this->assertInstanceOf(MustBeAStringException::class, $error_result);

        $this->expectException(MustBeAStringException::class);

        $custom::check($custom, 1, true);
    }
}
