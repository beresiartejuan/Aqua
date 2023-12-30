<?php

namespace Beresiartejuan\Aqua\Rules;

interface RuleInterface
{
    public static function check(mixed $value, bool $warning): true | \Exception;

    public function __invoke(mixed $value, bool $warning): true | \Exception;

    //public static function make(): RuleInterface;
}
