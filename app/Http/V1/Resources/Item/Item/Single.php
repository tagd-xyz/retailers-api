<?php

namespace App\Http\V1\Resources\Item\Item;

use App\Http\V1\Resources\Item\ItemImage\Collection as ItemImageCollection;
use App\Http\V1\Resources\Item\Tagd\Collection as TagdCollection;
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
            'images' => new ItemImageCollection($this->whenLoaded('images')),
            'createdAt' => $this->created_at,
            'tagds' => new TagdCollection($this->whenLoaded('tagds')),
            // 'rootTagd' => $this->root_tagd,
        ];
    }
}
