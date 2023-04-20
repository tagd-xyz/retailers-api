<?php

namespace App\Http\V1\Resources\Item\Stock;

use App\Http\V1\Resources\Item\StockImage\Collection as StockImageCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class Single extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'retailer' => $this->retailer->name,
            'description' => $this->description,
            'properties' => $this->properties,
            'images' => new StockImageCollection($this->whenLoaded('images')),
            'createdAt' => $this->created_at,
        ];
    }
}
