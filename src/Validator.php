<?php

namespace Beresiartejuan\Aqua;

use Beresiartejuan\Aqua\Exceptions\PointerMustNotBeNull;
use Beresiartejuan\Aqua\Rules\MustBeAString;

class Validator
{
    protected array $validators = [];

    protected string|null $pointer = null;

    public function __construct()
    {
    }

    public function check(object|array $obj)
    {
        $obj = (array) $obj;

        foreach ($this->validators as $validator) {

            $pointers = explode(".", $validator["pointer"]);

            $number_of_pointers = count($pointers);

            $value = null;

            for ($i = 0; $i <= ($number_of_pointers - 1); $i++) {
                $value = $obj[$pointers[$i]];
            }

            $rule = $validator["rule"];

            $rule::check($value);
        }

        return true;
    }

    public function getPointer()
    {
        return $this->pointer;
    }

    public function getValidators()
    {
        return $this->validators;
    }

    public function field(string $name): Validator
    {
        $this->pointer = $name;

        return $this;
    }

    public function string(): Validator
    {
        if (!$this->pointer) throw new PointerMustNotBeNull();

        array_push($this->validators, [
            "pointer" => $this->pointer,
            "rule" => MustBeAString::class
        ]);

        return $this;
    }

    public function number(): Validator
    {
        if (!$this->pointer) throw new PointerMustNotBeNull();

        return $this;
    }

    public function not(): Validator
    {
        if (!$this->pointer) throw new PointerMustNotBeNull();

        return $this;
    }

    public function empty(): Validator
    {
        if (!$this->pointer) throw new PointerMustNotBeNull();

        return $this;
    }

    public function custom(callable $callback): Validator
    {
        if (!$this->pointer) throw new PointerMustNotBeNull();

        return $this;
    }
}
