<?php

namespace App\Rules;

use Zttp\Zttp;
use Zttp\ZttpResponse;
use Illuminate\Support\Arr;
use Illuminate\Contracts\Validation\Rule;

class Recaptcha implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /** @var ZttpResponse $response */
        $response = Zttp::post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => config('services.recaptcha.secret'),
                'response' => $value,
            ],
        ]);

        return Arr::get($response->json(), 'success', false);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Google thinks your a robot ...';
    }
}
