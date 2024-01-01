<?php

namespace Beresiartejuan\Aqua\Rules;

interface RuleInterface
{
    public static function check(mixed $value, bool $warning): bool | \Exception;

    public function __invoke(mixed $value, bool $warning): bool | \Exception;

    //public static function make(): RuleInterface;
}
