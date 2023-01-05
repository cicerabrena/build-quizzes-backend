<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var  \Illuminate\Pagination\LengthAwarePaginator */
        $resource = $this->resource;

        return [
            'data' => $this->collection,
            'links' => [
                'first' => "http://localhost/api/users?page=1",
                'last' => "http://localhost/api/users?page=" . $resource->lastPage(),
                'prev' => $resource->previousPageUrl(),
                'next' => $resource->nextPageUrl()
            ],
            'meta' => [
                'current_page' => $resource->currentPage(),
                'from' => '',
                'to' => '',
                'total' => $resource->total(),
                'path' => '',
                'last_page' => $resource->lastPage(),
                'per_page' => $resource->perPage(),
            ]
        ];
    }
}
