<?php

namespace App\Http\Resources;

use App\Http\Resources\BookItem;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
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
            'data' => BookItem::collection($this->collection)
        ];
    }
}
