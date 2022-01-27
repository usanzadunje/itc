<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Time implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value) {
        // Checking if user provided at least 3 number values corresponding to hours, minutes and seconds
        // in any possible format
        preg_match_all('!\d+!', $value, $matches);

        return count($matches[0]) > 2;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        return 'Time must contain all time intervals(hours, minutes, seconds)';
    }
}
