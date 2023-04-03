<?php

namespace App\Http\V1\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public const NAME = 'name';

    public const DESCRIPTION = 'description';

    public const TYPE = 'type';

    public const PROPERTIES = 'properties';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            self::NAME => 'string|required',
            self::DESCRIPTION => 'string|required',
            self::TYPE => 'string|required',
            self::PROPERTIES => 'array',
        ];
    }
}
