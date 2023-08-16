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

    public const PRICE = 'price';

    public const PRICE_AMOUNT = 'price.amount';

    public const PRICE_CURRENCY = 'price.currency';

    public const LOCATION = 'location';

    public const LOCATION_CITY = 'location.city';

    public const LOCATION_COUNTRY = 'location.country';

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
            self::PRICE => 'array|required',
            self::PRICE_AMOUNT => 'numeric|required',
            self::PRICE_CURRENCY => 'string|required',
            self::LOCATION => 'array|required',
            self::LOCATION_CITY => 'string|required',
            self::LOCATION_COUNTRY => 'string|required',
            self::IMAGE_UPLOADS => 'array',
            self::IMAGE_UPLOADS . '.*' => 'string',
        ];
    }
}
