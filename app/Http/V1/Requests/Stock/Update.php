<?php

namespace App\Http\V1\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    public const IMAGE_UPLOADS = 'imageUploads';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            self::IMAGE_UPLOADS => 'array|required',
            self::IMAGE_UPLOADS . '.*' => 'string|required',
        ];
    }
}
