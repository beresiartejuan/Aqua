<?php

namespace Beresiartejuan\Aqua\Rules;

use Beresiartejuan\Aqua\Exceptions\MustBeNotEmptyException;

class MustBeNotEmpty extends Rule implements RuleInterface
{
    public static function check(mixed $value, bool $warning = true): bool | \Exception
    {
        if (empty($value)) {

            $exception = new MustBeNotEmptyException("The value must not be empty");

            if ($warning) {
                throw $exception;
            }

            return $exception;
        }

        return true;
    }

    public function __invoke(mixed $value, bool $warning = true): bool | \Exception
    {
        return $this::check($value, $warning);
    }
}
