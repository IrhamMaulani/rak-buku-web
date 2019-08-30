<?php

namespace App\Http\Resources;

use App\Http\Resources\UserItem;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
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
            'data' => UserItem::collection($this->collection)
        ];
    }
}
