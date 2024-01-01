<?php

namespace Beresiartejuan\Aqua;

use Beresiartejuan\Aqua\Exceptions\InvalidRuleException;
use Beresiartejuan\Aqua\Exceptions\PointerMustNotBeNull;
use Beresiartejuan\Aqua\Rules\CustomRule;
use Beresiartejuan\Aqua\Rules\MustBeANumber;
use Beresiartejuan\Aqua\Rules\MustBeAString;
use Beresiartejuan\Aqua\Rules\MustBeNotEmpty;

class Validator
{
    protected array $rules = [];

    protected string|null $pointer = null;

    public function __construct()
    {
    }

    public function check(object | array $obj, bool $alert = false)
    {
        $obj = (array) $obj;

        foreach ($this->rules as $actual_pointer => $rules) {

            $pointers = explode(".", $actual_pointer);

            $number_of_pointers = count($pointers);

            $value = null;

            for ($i = 0; $i <= ($number_of_pointers - 1); $i++) {
                $value = $obj[$pointers[$i]];
            }

            foreach ($rules as $rule) {
                $result = new InvalidRuleException();

                if ($rule instanceof CustomRule) {
                    $result = $rule::check($rule, $value, $alert);
                } else {
                    $result = $rule::check($value, $alert);
                }

                if ($result !== true) {
                    return $result;
                }

            }
        }

        return true;
    }

    public function getPointer()
    {
        return $this->pointer;
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function field(string $name): Validator
    {
        $this->pointer = $name;

        if (!array_key_exists($this->pointer, $this->rules)) {
            $this->rules[$this->pointer] = [];
        }

        return $this;
    }

    public function string(): Validator
    {
        if (!$this->pointer) {
            throw new PointerMustNotBeNull();
        }

        array_push($this->rules[$this->pointer], MustBeAString::class);

        return $this;
    }

    public function number(): Validator
    {
        if (!$this->pointer) {
            throw new PointerMustNotBeNull();
        }

        array_push($this->rules[$this->pointer], MustBeANumber::class);

        return $this;
    }

    public function notEmpty(): Validator
    {
        if (!$this->pointer) {
            throw new PointerMustNotBeNull();
        }

        array_push($this->rules[$this->pointer], MustBeNotEmpty::class);

        return $this;
    }

    public function custom(callable $callback): Validator
    {
        if (!$this->pointer) {
            throw new PointerMustNotBeNull();
        }

        array_push($this->rules[$this->pointer], new CustomRule($callback));

        return $this;
    }
}
