<?php

namespace Beresiartejuan\Aqua\Rules;

class CustomRule
{
    protected $rule;

    public function __construct(callable $rule)
    {
        $this->rule = $rule;
    }

    public static function check(CustomRule $custom, mixed $value, bool $warning): true | \Exception
    {
        $rule = $custom->rule;

        if (is_callable($rule)) {
            try {
                $rule($value);
            } catch (\Exception $e) {
                if ($warning) {
                    throw $e;
                }

                return $e;
            }

            return true;
        }

        return new \Exception("CustomRule must be callable");
    }

    public function __invoke(CustomRule $custom, mixed $value, bool $warning = true): true | \Exception
    {
        return $this::check($custom, $value, $warning);
    }
}
