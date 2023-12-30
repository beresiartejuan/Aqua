<?php

namespace Beresiartejuan\Aqua\Rules;

use Beresiartejuan\Aqua\Exceptions\MustBeAStringException;

class MustBeAString extends Rule implements RuleInterface
{
    public static function check(mixed $value, bool $warning = true): true | \Exception
    {
        if (!is_string($value)) {

            $exception = new MustBeAStringException("The value must be a string");

            if ($warning) throw $exception;

            return $exception;
        }

        return true;
    }

    public function __invoke(mixed $value, bool $warning = true): true | \Exception
    {
        return $this::check($value, $warning);
    }
}
