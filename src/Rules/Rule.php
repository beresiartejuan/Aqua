<?php

namespace Beresiartejuan\Aqua\Rules;

abstract class Rule implements RuleInterface
{
    public static function check(mixed $value, bool $warning = true): true | \Exception
    {
        return true;
    }

    public function __invoke(mixed $value, bool $warning = true): true | \Exception
    {
        return $this::check($value, $warning);
    }
}
