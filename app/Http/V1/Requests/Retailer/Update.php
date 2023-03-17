<?php

namespace App\Http\V1\Requests\Retailer;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    public const NAME = 'name';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            self::NAME => 'string|required',
        ];
    }
}
