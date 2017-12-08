<?php

namespace ValueObjects\Boolean;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\StringLiteral\StringLiteral;

class BooleanString extends StringLiteral
{
    /**
     * Returns a BooleanString object
     *
     * @param string $value
     */
    public function __construct($value)
    {
        if (null === \filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
            throw new InvalidNativeArgumentException($value, array('string (boolean value)'));
        }

        $this->value = $value;
    }

    /**
     * Returns the bool value of the BooleanString
     *
     * @return bool
     */
    public function toBool()
    {
        return \filter_var($this->value, FILTER_VALIDATE_BOOLEAN);
    }
}
