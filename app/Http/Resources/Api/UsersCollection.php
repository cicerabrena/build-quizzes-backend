<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'links' => [
                'first' => "http://localhost/api/users?page=1",
                'last' => "http://localhost/api/users?page=" . $this->resource->lastPage(),
                'prev' => $this->resource->previousPageUrl(),
                'next' => $this->resource->nextPageUrl()
            ],
            'meta' => [
                'current_page' => $this->resource->currentPage(),
                'from' => '',
                'to' => '',
                'total' => $this->resource->total(),
                'path' => '',
                'last_page' => $this->resource->lastPage() ?? null,
                'per_page' => $this->resource->perPage(),
            ]
        ];
    }
}
