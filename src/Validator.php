<?php

namespace Beresiartejuan\Aqua;

use Beresiartejuan\Aqua\Exceptions\PointerMustNotBeNull;

class Validator
{
    protected array $validators = [];

    protected string|null $pointer = null;

    public function __construct()
    {
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
        if (!array_key_exists($name, $this->validators))
            $this->validators[$name] = [];

        $this->pointer = $name;

        return $this;
    }

    public function string(): Validator
    {
        if (!$this->pointer) throw new PointerMustNotBeNull();

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
