<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxWordsCount implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($max_words = 300)
    {
        $this->max_words = $max_words;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return str_word_count($value) <= $this->max_words;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute cannot be longer than '.$this->max_words.' words.';
    }
}
