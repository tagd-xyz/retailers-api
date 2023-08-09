<?php

namespace App\Http\V1\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public const NAME = 'name';

    public const DESCRIPTION = 'description';

    public const TYPE = 'type';

    public const PROPERTIES = 'properties';

    public const CONSUMER = 'consumer';

    public const TRANSACTION = 'transaction';

    public const IMAGE_UPLOADS = 'imageUploads';

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
            self::TYPE => 'numeric|required',
            self::PROPERTIES => 'array',
            self::CONSUMER => 'string|required',
            self::TRANSACTION => 'string|required',
            self::IMAGE_UPLOADS => 'array',
            self::IMAGE_UPLOADS . '.*' => 'string',
        ];
    }
}
