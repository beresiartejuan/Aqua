<?php

namespace Beresiartejuan\Aqua\Rules;

use Beresiartejuan\Aqua\Exceptions\MustBeANumberException;

class MustBeANumber extends Rule implements RuleInterface
{
    public static function check(mixed $value, bool $warning = true): true | \Exception
    {
        if (!is_numeric($value)) {

            $exception = new MustBeANumberException("The value must be a number");

            if ($warning) {
                throw $exception;
            }

            return $exception;
        }

        return true;
    }

    public function __invoke(mixed $value, bool $warning = true): true | \Exception
    {
        return $this::check($value, $warning);
    }
}
