<?php

namespace App\Http\Resources;

use App\Http\Resources\ReputationItem;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReputationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => ReputationItem::collection($this->collection)
        ];
    }
}
